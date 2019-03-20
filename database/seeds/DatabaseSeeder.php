<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $adminReal = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'NIF' => 'No se que es un NIF',
            'contacto' => 'Contacto',
            'cuentaSkype' => 'Cuenta de Skype',
            'digital_sign' => $faker->unique()->uuid,
            'role' => 0,
            'confirmed' => true,
        ]);
        $admin = factory(App\User::class)->create([
            'role' => 0,
        ]);
        $devs = factory(App\User::class)->times(10)->create([
          'role' => 1,
      ]);
        $clients = factory(App\User::class)->times(10)->create([
          'role' => 2,
      ]);

        $clients->each(function(App\User $user) use ($admin,$devs){

            if(random_int(0,100) >50 ){
                factory(App\Dossier::class)
                ->create( [
                   'user_id' => $user->id,
               ]);                
            }

            if(random_int(0,100) >50 ){
                factory(App\adminSocialNetwork::class)
                ->create( [
                   'user_id' => $user->id,
               ]);                
            }
            /*
            Crear valores de prueba que no esten asignados a proyectos
            */

            $dossiers = factory(App\Dossier::class)
            ->times(3)
            ->create( [
               'user_id' => $user->id,
           ]);

            $dossiers->each(function(App\Dossier $p) use($admin,$devs){
                $proyect = factory(App\Proyect::class)
                ->create( [
                    'user_id' => $admin->id,
                    'proyect_id' => $p->id,
                    'proyect_type' => 0,
                ]);
                
                $d = factory(App\Dev::class)
                ->create( [
                    'proyect_id' => $proyect->id,
                    'user_id' => $devs[random_int(0, 9)],
                ]);
                factory(App\Comment::class)
                ->create( [
                    'proyect_id' => $proyect->id,
                    'user_id' => $d->user->id,
                ]);
                
            });

            $ASN = factory(App\adminSocialNetwork::class)
            ->times(3)
            ->create( [
               'user_id' => $user->id,
           ]);

            $ASN->each(function(App\adminSocialNetwork $p) use ($admin,$devs){
                $proyect = factory(App\Proyect::class)
                ->create( [
                    'user_id' => $admin->id,
                    'proyect_id' => $p->id,
                    'proyect_type' => 1,
                ]);

                $d = factory(App\Dev::class)
                ->create( [
                    'proyect_id' => $proyect->id,
                    'user_id' => $devs[random_int(0, 9)],
                ]);
                factory(App\Comment::class)
                ->create( [
                    'proyect_id' => $proyect->id,
                    'user_id' => $d->user->id,
                ]);                        

            });

        });
    	 // $users->each(function( App\User $user) use ($users){//Darle acceso a la variable externa $users
    	 // 	factory(App\Proyect::class)
    	 // 	->times(20)
    	 // 	->create( [
    	 // 		'user_id' => $user->id,
    	 // 	]);
      //       //Le hacemos seguir a 50 usuarios al azar
    	 // 	$user->follows()->sync(
    	 // 		$users->random(10)
    	 // 	);    
    	 // });
        // $this->call(UsersTableSeeder::class);
    }
}
