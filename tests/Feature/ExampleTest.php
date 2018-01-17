<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //Arrange | Preparacion
        //Puede tenerla

        //Act | Accion
        //Tiene que tenerla

        // Assert | Verificacion
        //Una o mas verificaciones
        $response = $this->get('/');

        $response->assertStatus(302);
        // $response->assertSee('Leanga');
    }

    // public function testPrueba()
    // {
    //     $response = $this->get('/admin/users');

    //     $response->assertSee('admin');

    // }
}
