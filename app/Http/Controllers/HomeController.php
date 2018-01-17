<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Proyect;
use App\adminSocialNetwork;
use App\Dossier;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::find(1);
        // $dossiers = Dossier::find(1);
        // $user->proyects()->save($dossiers);
        // dd( $user->proyects()->first()->dossiers());
        // // $tag->entities()->save(new Entity(...));
        // // $user->proyects()->sync(Proyect::limit(3)->get());
        // foreach (Auth::user()->proyects->first()->dossiers() as $variable) {
        //     echo 'noooooooooooooooo';
        //     dd($variable);
        // } ;
        switch ( Auth::user()->role ) {
            case 0:// admin
            return view("admin.home", [
                'users' => User::all(),
                'proyects' =>Proyect::all(),
            ]);
            break;

            case 1://Desarrollador
            return view('dev.home',[
                'devs' => Auth::user()->devs,
            ]);
            // return redirect()->back();
            break;

            case 2://Cliente
            return view('home');
            break;
            
            default:
            return view('home');
            break;
        }
    }
}
