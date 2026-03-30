<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absen extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staf_id',
        'tapel_id',
        'status',
        'type',
        'tanggal',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'id' => 'integer',
    //     'guru_id' => 'integer',
    //     'tapel_id' => 'integer',
    //     'tanggal' => 'date',
    // ];

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class);
    }

    public function tapel(): BelongsTo
    {
        return $this->belongsTo(Tapel::class);
    }

    public function scopeTapel($query, $id) {
      return $query->where('tapel_id', $id);
    }

    public function bulan($query, $tglAwal, $tglAkhir) {
      return $query->whereBetween('tanggal', [$tglAwal, $tglAkhir]);
    }
}
