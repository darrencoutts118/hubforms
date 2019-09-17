<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FormSeeder::class);

        // create the users
        factory(App\User::class)->make([
            'email' => 'demo@demo.com'
        ]);

        factory(App\User::class, 100)->make();
    }
}
