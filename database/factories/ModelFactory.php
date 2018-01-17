<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('123456'),
		'remember_token' => str_random(10),
		'NIF' => $faker->words(random_int(3, 10), true),
		'contacto' => $faker->userName,
		'cuentaSkype' => $faker->userName,
		'digital_sign' => $faker->unique()->uuid,
		'confirmed' =>true,
		// 'role' => random_int(1, 2),
	];
});

$factory->define(App\Proyect::class, function (Faker\Generator $faker) {

	return [
		'nombre' => $faker->company,
		'fecha_limite' => $faker->dateTimeBetween('now','+1 years'),
	];
});

$factory->define(App\Dev::class, function (Faker\Generator $faker) {

	return [
		'diasTrabajado' => $faker->numberBetween(0,2),
		'horasTrabajado' => $faker->numberBetween(0,23),
		'minutosTrabajado' => $faker->numberBetween(0,59),
		'segundosTrabajado' => $faker->numberBetween(0,59),
	];
});	

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

	return [
		'texto' => $faker->realText(50,1),
	];
});
//Proyectos de cliente
$factory->define(App\Dossier::class, function (Faker\Generator $faker) {
	return [
		'nombre' => $faker->company,
		'queEs' => $faker->words(random_int(3, 10), true),
		'publico' => $faker->words(random_int(3, 10), true),
		'mision' => $faker->words(random_int(3, 10), true),
		'vision' => $faker->words(random_int(3, 10), true),
		'vision' => $faker->words(random_int(3, 10), true),
		'valores' => $faker->words(random_int(3, 10), true),
		'servicios' => $faker->words(random_int(3, 10), true),
		'crecimiento' => $faker->words(random_int(3, 10), true),
		'que_se_puede_encontrar' => $faker->words(random_int(3, 10), true),
		'cualidades' => $faker->words(4, true),
		'comentarios' => $faker->words(random_int(3, 10), true),
		'created_at' => $faker->dateTimeThisDecade,
		'updated_at' => $faker->dateTimeThisDecade,
	];
});

$factory->define(App\adminSocialNetwork::class, function (Faker\Generator $faker) {
	return [
		'nombre' => $faker->company,
		'facebook' => $faker->boolean,
		'fbPermisosCompra' => $faker->words(random_int(3, 10), true),
		'twitter' => $faker->boolean,
		'twEmail' => $faker->safeEmail,
		'twPassword' => $faker->password,
		'instagram' => $faker->boolean,
		'instEmail' => $faker->safeEmail,
		'instPassword' => $faker->password,
		'created_at' => $faker->dateTimeThisDecade,
		'updated_at' => $faker->dateTimeThisDecade,
	];
});
//Proyectos de clientes