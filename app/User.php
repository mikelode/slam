<?php

namespace Logistica;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function dependencia()
    {
        return $this->hasOne('Logistica\Almacen\almTLogDep','depID','usrDep');
    }

    public function permiso($modId, $modOpt, $usrId)
    {
        $accesos = $this->accesos($usrId, $modId);
        switch ($modOpt){
            case 'VER':
                $rpta = $accesos->mdlVer;
                break;
            case 'GUARDAR':
                $rpta = $accesos->mdlCre;
                break;
            case 'EDITAR':
                $rpta = $accesos->mdlMod;
                break;
            case 'ELIMINAR':
                $rpta = $accesos->mdlEli;
                break;
            case 'IMPRIMIR':
                $rpta = $accesos->mdlImp;
                break;
            default:
                $rpta = 0;
        }

       return $rpta;

    }

    public function accesos($idUsr, $modId)
    {
        return DB::table('TSisUsr')
                    ->leftJoin('TSisModDll','TSisUsr.usrID','=','TSisModDll.mdlUsrID')
                    ->where('mdlUsrID',$idUsr)
                    ->where('mdlModID',$modId)
                    ->first();
    }
}
