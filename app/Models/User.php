<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'username',
    //     'password',
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'id' => 'integer',
    // ];

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    public function staf(): HasOne
    {
        return $this->hasOne(Staf::class);
    }

    public function kapus(): HasOne
    {
        return $this->hasOne(Kapus::class);
    }
    public function setPasswordAttribute($password) {
      $this->attributes['password'] = bcrypt($password);
    }

    public function isAdmin()
    {
      return $this->role == 'admin';
    }

    public function isStaf()
    {
      return $this->role == 'staf';
    }


    public function isKapus()
    {
      return $this->role == 'kapus';
    }
}
