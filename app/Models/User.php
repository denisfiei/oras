<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Notifications\MailResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres', 'codigo_tel', 'telefono', 'email', 'password', 'tipo', 'perfil', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPassword($token));
    }

    public function rol()
    {
        return $this->hasOne(Rol::class, 'id', 'rol_id')->select('id', 'nombre');
    }
    
    public function pais()
    {
        return $this->hasOne(Pais::class, 'id', 'pais_id')->select('id', 'nombre', 'bandera');
    }
    
    public function laboratorio()
    {
        return $this->hasOne(Laboratorio::class, 'id', 'laboratorio_id')->select('id', 'nombre');
    }
}
