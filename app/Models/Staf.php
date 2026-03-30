<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staf extends Model
{
    use HasFactory;

    // ✅ Tambahkan baris ini untuk memperbaiki error
    protected $table = 'staf';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nip',
        'nuptk',
    ];

    public function barcode(): HasOne
    {
        return $this->hasOne(Barcode::class);
    }

    public function absen(): HasMany
    {
        return $this->hasMany(Absen::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
