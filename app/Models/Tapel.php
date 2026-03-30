<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use tidy;

class Tapel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tahun',
        'periode',
        'mulai',
        'selesai',
        'is_aktif',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'id' => 'integer',
    //     'mulai' => 'date',
    //     'selesai' => 'date',
    //     'is_aktif' => 'boolean',
    // ];

    public function absens(): HasMany
    {
        return $this->hasMany(Absen::class);
    }

    public function tahunPeriode() {
      return  $this->tahun . ' - Periode ' . $this->periode == '1' ? 'Periode I' : 'Periode II';
    }

    public function periode() {
      return $this->periode == '1' ? 'Periode I' : 'Periode II';
    }

    public function mulai() {
      return Carbon::createFromFormat('Y-m-d', $this->mulai)->locale('id')->isoFormat('D MMMM YYYY');
    }

    public function selesai() {
      return Carbon::createFromFormat('Y-m-d', $this->selesai)->locale('id')->isoFormat('D MMMM YYYY');
    }
}
