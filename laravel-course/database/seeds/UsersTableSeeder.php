<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('users')->insert(
        // 	[
        // 		'name' => 'Administrator',
		      //   'email' => 'admin@mail.com',
		      //   'email_verified_at' => now(),
		      //   'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
		      //   'remember_token' => Str::random(10)
        // 	]
        // );

        factory(\App\User::class, 50)->create()->each(function ($user) {
            // Para cada usuário criado, vai ser criado uma loja e vinculado com o usuário
            $user->store()->save(factory(\App\Store::class)->make());
        });
    }
}
