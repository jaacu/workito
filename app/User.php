<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Proyect;
use App\adminSocialNetwork;
use App\Dossier;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','NIF','contacto','cuentaSkype','digital_sign','confirmed','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function proyectsClient(){//Proyectos relacionados con el usuario
        //Ordenado de una vez por los que les queda menos tiempo
        // return $this->hasMany(Proyect::class)->orderBy('id','asc');
        if( $this->isClient()){
            $proyects = Proyect::all();
            $AdmSN = $this->adminSocialNetworks;
            $dossiers = $this->dossiers;

            $data = array();
            foreach ($proyects as $proyect) {
                foreach ($AdmSN as $proy) {
                    if($proy->encontrar() == $proyect){
                        if( ! in_array($proyect, $data) ){
                            array_push( $data, $proyect );
                        }
                    }
                }
                foreach ($dossiers as $proy) {
                    if($proy->encontrar() == $proyect){
                        if( ! in_array($proyect, $data) ){                            
                            array_push( $data, $proyect );
                        }
                    // dd($proyect->encontrarDossier($proy->id));
                    }
                }
            }
            return $data;
        } else
        return null;
    }

    public function proyects(){
        return $this->hasMany(Proyect::class)->orderBy('updated_at','desc');   
    }

    public function adminSocialNetworks(){
        return $this->hasMany(adminSocialNetwork::class)->orderBy('updated_at','desc');   
    }
    public function dossiers(){
        return $this->hasMany(Dossier::class)->orderBy('updated_at','desc');   
    }

    public function comments(){
        //Ordenado de una vez por los que les queda menos tiempo
        return $this->hasMany(Comment::class)->orderBy('updated_at','desc');
    }

    public function devs(){
        //Ordenado de una vez por los que les queda menos tiempo
        return $this->hasMany(Dev::class)->orderBy('id','asc');
    }

    public function isConfirmed(){
        return $this->confirmed;
    }

    public function isAdmin(){
        return ($this->role == 0);
    }

    public function isDeveloper(){
        return ($this->role == 1);
    }

    public function isClient(){
        return ($this->role == 2);      
    }

}
