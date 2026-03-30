<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kapus extends Model
{
    use HasFactory;

    // 🔥 Tambahkan baris ini supaya Laravel pakai tabel "kapus", bukan "kapuses"
    protected $table = 'kapus';

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nip',
        // 'nuptk',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'id' => 'integer',
    //     'user_id' => 'integer',
    // ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
