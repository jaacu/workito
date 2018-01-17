<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifiedMail;
use App\User;

class PageController extends Controller
{
	public function login(){
		return redirect(route('login'));
	}

	public function perfil(){
		
		switch ( Auth::user()->role ) {
            case 0:// admin
            return view('admin.perfil');
            break;

            case 1://Desarrollador
            return view('dev.perfil');
            break;

            case 2://Cliente
            return view('user.perfil');
            break;
            
            default:
            abort(500);
            break;
          }
        }

        public function confirmar(){
          if(Auth::user()->isConfirmed()){
            return redirect('/home');
          } else {
           return view('user.confirmar');
         }
       }

       public function confirm(Request $request){
         $user = Auth::user();

         $this->validate($request,[
          'digital_sign' => 'required',
        ]);

         if($user->digital_sign == $request->input('digital_sign') ){
          $user->confirmed = true;
          $user->save();
          return redirect('/home')->withSuccess('Cuenta verificada con exito.');
        } else {
          return redirect()->back()->withErrors('La firma digital no concuerda la enviada en tu correo, intentalo de nuevo.');
        }

      }

      public function editar(){
       return view('user.editar');
     }

     public function edit(Request $request)
     {
       $user = Auth::user();

       $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($user->id)],
        'NIF' => 'sometimes|required|max:255',
        'contacto' => 'sometimes|required|max:255',
        'cuentaSkype' => 'sometimes|required|max:255',
      ]);

       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->NIF = $request->input('NIF',$user->NIF);
       $user->contacto = $request->input('contacto',$user->contacto);
       $user->cuentaSkype = $request->input('cuentaSkype',$user->cuentaSkype);

       $user->save();
       return redirect(route('user.perfil'))->withSuccess('Cambios Guardados Con exito!');
     }

     public function mail(){
       $user = Auth::user();
       if( ! $user->isConfirmed()){
        $this->ReSendMail($user);
        return redirect(route('home'))->withSuccess('Se ha reenviado el codigo a la cuenta: '.$user->email);
      }
      else{
        return redirect()->back();
      }
    }

    public function ReSendMail(User $user){
     Mail::to( $user )->send( new VerifiedMail($user) );
   }

   public function notifications(Request $request)
   {
    return $request->user()->notifications;
  }

  public function leerNotificaciones(){
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->back()->withSuccess('Notificaciones marcadas como leidas con exito!');
  }

  public function eliminarNotificaciones(){
    Auth::user()->readNotifications()->delete();
    return redirect()->back()->withSuccess('Notificaciones leidas eliminadas con exito!');
  }

}
