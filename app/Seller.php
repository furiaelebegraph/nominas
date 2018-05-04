<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Class which implements Illuminate\Contracts\Auth\Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

//Notification for Seller
use App\Notifications\SellerResetPasswordNotification;

//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    // This trait has notify() method defined
    use Notifiable;
    function nomina(){
        return $this->hasMany('App\Nomina','seller_id', 'id');
    }

    public static function obtenerNomina($id){
        return Nomina::where('id_sellers', '=', $id )->select('nombre','id', 'imagen', 'titulo', 'descripcion', 'precio')->orderBy('DESC')->paginate(9);
    }
    //Mass assignable attributes
    protected $fillable = [
      'nombre', 'correo', 'password', 'telefono', 'verificado', 'direccion', 'nss','emailtoken'
    ];

    //hidden attributes
    protected $hidden = [
       'password', 'remember_token',
    ];

    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SellerResetPasswordNotification($token));
    }
}
