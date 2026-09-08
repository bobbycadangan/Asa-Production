<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));

        $items = ContactMessage::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->latestFirst()
            ->paginate(15)
            ->withQueryString();

        $total = ContactMessage::count();
        $unread = ContactMessage::unread()->count();

        return view('admin.contact-messages.index', compact('items', 'search', 'total', 'unread'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if (! $contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }

        return view('admin.contact-messages.show', ['item' => $contactMessage]);
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }

    /**
     * Endpoint ringan untuk polling — dipakai oleh sidebar admin (badge jumlah
     * pesan belum dibaca) dan halaman daftar pesan (auto-refresh saat ada
     * pesan baru), tanpa perlu websocket/Pusher.
     */
    public function pollStatus()
    {
        return response()->json([
            'unread' => ContactMessage::unread()->count(),
            'total' => ContactMessage::count(),
            'latest_id' => ContactMessage::latestFirst()->value('id'),
        ]);
    }
}
