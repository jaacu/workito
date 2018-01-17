<?php

namespace App;

use App\Dossier;
use App\Proyect;
use App\adminSocialNetwork;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        if( $this->isClient() ){
            $proyects = Proyect::all();
            $todos = $this->getProyects();
            $data = array();
            foreach ($proyects as $proyect) {
                foreach ($todos as $uno) {
                    if ($uno->encontrar()) {                  
                        if($uno->encontrar()->id == $proyect->id){
                            if( ! in_array($proyect, $data) ){
                                array_push( $data, $proyect );
                            }
                        }
                    }
                }
            }
            return $data;
        } else{
            return [];
        }
    }
    public function getProyects(){
        if ($this->isClient() ) {
            return $this->adminSocialNetworks->concat($this->dossiers);
        }
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
        return $this->hasMany(Dev::class)->orderBy('updated_at','desc');
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

    public function hasProyects(){
        if ($this->isClient()) {
            return ( $this->adminSocialNetworks->count() or $this->dossiers->count() );
        }
        return false;
    }
    public function getRoleString(){
        $string;
        switch ($this->role) {
            case 0:
            $string = 'Admin';
            break;
            case 1:
            $string = 'Desarrollador';
            break;
            case 2:
            $string = 'Cliente';
            break;
            default:
            $string = 'Error';
            abort(500);
            break;
        }
        return $string;
    }

    public function getRoleColor(){
        $color;
        switch ($this->role) {
            case 0:
            $color = 'primary';
            break;
            case 1:
            $color = 'success';
            break;
            case 2:
            $color = 'dark';
            break;
            default:
            $color = 'Error';
            abort(500);
            break;
        }
        return $color;   
    }

    public function forHumansCreado(){
        Carbon::setLocale('es');
        $now = new Carbon();
        $time = $this->carbonFormat($this->created_at);
        $creado = Carbon::create($time[0],$time[1],$time[2],$time[3],$time[4],$time[5]);
        return $creado->diffForHumans($now);
    }

    public function forHumansEditado(){
        // Carbon::setLocale('es');
        $now = new Carbon();
        $time = $this->carbonFormat($this->updated_at);
        $creado = Carbon::create($time[0],$time[1],$time[2],$time[3],$time[4],$time[5]);
        return $creado->diffForHumans($now);
    }

    public function carbonFormat($string){
        return preg_split("/[- :]/", $string);
    }
}
