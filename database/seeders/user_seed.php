<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class user_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Factory::create();
        $user = new User;
        $user->email ='ahmed@yahoo.com';
        $user->name ='ahmed';
        $user->password =Hash::make('88888888');
        $user->save();
        $user->attachRole('super-admin');
        $user->save();


        $users =[];

        for($x =1;$x <= 100; $x++){

            $name = $faker->unique()->name();
            $email = $faker->unique()->email();
            $created_at = $faker->unique()->dateTimeBetween('-3 years' , 'now');
            $password = $faker->unique()->password();

            $user =[
                'name'=>$name,
                'email'=>$email,
                'created_at'=>$created_at,
                'password'=>Hash::make($password),
            ];


            $users[] =$user;

        };


        $chunks = array_chunk($users, 50);


        foreach ($chunks as $chunk) {
            User::insert($chunk);
        }



        $admins = User::whereDoesntHaveRole()->limit(10)->get();

        $roles = collect(['admin', 'moderator']);
        foreach($admins as $admin){
            $admin->attachRole($roles->random());
            $admin->save();
        }




        $users =[];

        for($x =1;$x <= 2000; $x++){

            $name = $faker->unique()->name();
            $email = $faker->unique()->email();
            $created_at = $faker->unique()->dateTimeBetween('-3 years' , 'now');
            $password = $faker->unique()->password();

            $user =[
                'name'=>$name,
                'email'=>$email,
                'created_at'=>$created_at,
                'password'=>Hash::make($password),
            ];


            $users[] =$user;

        };


        $chunks = array_chunk($users, 50);


        foreach ($chunks as $chunk) {
            User::insert($chunk);
        }



    }
}
