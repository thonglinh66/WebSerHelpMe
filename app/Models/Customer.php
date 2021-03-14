<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Notifiable;

    protected $table = 'customer    ';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'id',
        'usernameId',
        'fullname',
        'decription',
        'birthDay',
        'avatar',
        'background'
    ];
    public $timestamps = false;
 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

}
