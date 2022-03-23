<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        $this->call(LaratrustSeeder::class);
        $this->call(user_seed::class);
        $this->call(food::class);
        $this->call(meal::class);
        $this->call(SettingsSeeder::class);
        $this->call(ContactSeeder::class);






    }
}
