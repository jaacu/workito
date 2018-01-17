<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
class UsersTest extends TestCase
{
    use DatabaseTransactions;
    use InteractsWithDatabase;

    public function testCanLogin()
    {
        $user = factory(User::class)->create([
            'role' => 0,
        ]);

        $response = $this->post('/login',[
            'email' => $user->email,
            'password' => '123456',
        ]);

        $this->seeIsAuthenticatedAs($user);
    }

    public function testCanCreateUser()
    {

        $admin = factory(User::class)->create([
            'role' => 0,
        ]);
        
        // $this->seeIsAuthenticatedAs($admin);

        $response = $this->actingAs($admin)->post('/user/create',[
            'name' => 'perenzejo',
            'email' => 'emailtotalnofake@dddd.com',
            'password' => '123456',
            'NIF' => 'No se que es un nif',
            'contacto' => '$faker->userName',   
            'cuentaSkype' => '$faker->userName',
        ]);

        // $response2->
        $this->assertDatabaseHas('users',[
            'email' => 'emailtotalnofake@dddd.com',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }


}
