@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
@php
  $cards = [
    ['label' => 'Tim Kami', 'value' => $stats['team'], 'icon' => 'bi-people-fill', 'route' => 'admin.team.index', 'color' => '#2E8BFF'],
    ['label' => 'Layanan', 'value' => $stats['services'], 'icon' => 'bi-stars', 'route' => 'admin.services.index', 'color' => '#0051B5'],
    ['label' => 'Portofolio', 'value' => $stats['portfolios'], 'icon' => 'bi-images', 'route' => 'admin.portfolio.index', 'color' => '#0EA5A0'],
    ['label' => 'Artikel Blog', 'value' => $stats['posts'], 'icon' => 'bi-journal-text', 'route' => 'admin.posts.index', 'color' => '#F2A93B'],
    ['label' => 'Testimoni', 'value' => $stats['testimonials'], 'icon' => 'bi-chat-quote-fill', 'route' => 'admin.testimonials.index', 'color' => '#003D8F'],
    ['label' => 'Partner', 'value' => $stats['partners'], 'icon' => 'bi-diagram-3-fill', 'route' => 'admin.partners.index', 'color' => '#4C6FFF'],
    ['label' => 'Sertifikat', 'value' => $stats['certificates'], 'icon' => 'bi-patch-check-fill', 'route' => 'admin.certificates.index', 'color' => '#00224C'],
    ['label' => 'FAQ', 'value' => $stats['faqs'], 'icon' => 'bi-question-circle-fill', 'route' => 'admin.faqs.index', 'color' => '#17A2E8'],
  ];
@endphp

<div class="row g-3 mb-4">
  @foreach($cards as $c)
  <div class="col-6 col-md-4 col-lg-3">
    <a href="{{ route($c['route']) }}" class="text-decoration-none">
      <div class="card shadow-sm h-100 border-0" style="border-left: 4px solid {{ $c['color'] }} !important;">
        <div class="card-body d-flex align-items-center gap-3">
          <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
               style="width:46px;height:46px;background:{{ $c['color'] }}1a;color:{{ $c['color'] }};">
            <i class="bi {{ $c['icon'] }} fs-5"></i>
          </div>
          <div>
            <h4 class="mb-0 text-dark fw-bold">{{ $c['value'] }}</h4>
            <div class="text-muted small">{{ $c['label'] }}</div>
          </div>
        </div>
      </div>
    </a>
  </div>
  @endforeach
</div>

<div class="row g-3 mb-4">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-white d-flex align-items-center justify-content-between">
        <span><i class="bi bi-lightning-charge-fill me-2 text-warning"></i>Akses Cepat</span>
      </div>
      <div class="card-body">
        <div class="d-flex flex-wrap gap-2">
          <a href="{{ route('admin.portfolio.create') }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-plus-lg me-1"></i>Portofolio Baru</a>
          <a href="{{ route('admin.posts.create') }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-plus-lg me-1"></i>Tulis Artikel</a>
          <a href="{{ route('admin.services.create') }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-plus-lg me-1"></i>Layanan Baru</a>
          <a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-plus-lg me-1"></i>Testimoni Baru</a>
          <a href="{{ route('admin.team.create') }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-plus-lg me-1"></i>Anggota Tim Baru</a>
          <a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-plus-lg me-1"></i>FAQ Baru</a>
          <a href="{{ route('admin.settings.edit') }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-gear me-1"></i>Pengaturan Situs</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-12">
    <div class="card shadow-sm h-100">
      <div class="card-header bg-white d-flex align-items-center justify-content-between">
        <span><i class="bi bi-chat-quote-fill me-2 text-primary"></i>Testimoni Terbaru</span>
        <a href="{{ route('admin.testimonials.index') }}" class="small text-decoration-none">Lihat semua</a>
      </div>
      <div class="card-body p-0">
        <table class="table mb-0 align-middle">
          <tbody>
            @forelse($recentTestimonials as $t)
              <tr>
                <td class="ps-3">
                  <div class="fw-semibold">{{ $t->name }}</div>
                  <div class="text-muted small">{{ \Illuminate\Support\Str::limit($t->message, 50) }}</div>
                </td>
                <td class="text-muted small text-end pe-3">{{ $t->created_at?->diffForHumans() }}</td>
              </tr>
            @empty
              <tr><td class="text-muted p-3 text-center">Belum ada testimoni.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
