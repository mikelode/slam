<?php

namespace Logistica;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TSisUsr';
    protected $primaryKey = 'usrID';
    public $timestamps = false;
    public $remember_token = false;

    protected $fillable = ['usrID', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function persona()
    {
        return $this->hasOne('Logistica\Almacen\almTPerPrs','perID','usrID');
    }


}
