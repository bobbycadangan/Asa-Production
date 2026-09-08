<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    /**
     * Settings is a single-row table. Always fetch (or create) row #1.
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
