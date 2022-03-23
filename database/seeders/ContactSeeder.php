<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;


class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts =[];
        $faker =Factory::create();



        $status_options =[0,1];
        for($x =1;$x <= 500; $x++){

            $name = $faker->unique()->name();
            $email = $faker->unique()->email();
            $created_at = $faker->unique()->dateTimeBetween('-3 years' , 'now');
            $ip = $faker->unique()->ipv6();
            $message =$faker->unique()->sentence(mt_rand(3,6));
            $subject =$faker->unique()->sentence(mt_rand(1,2));

            $read =collect($status_options)->random();


            $contact =[
                'name'=>$name,
                'email'=>$email,
                'ip'=>$ip,
                'message'=>$message,
                'subject'=>$subject,
                'read'=>$read,
                'created_at'=>$created_at,
            ];


            $contacts[] =$contact;

        };


        $chunks = array_chunk($contacts, 50);


        foreach ($chunks as $chunk) {
            Contact::insert($chunk);
        }




    }
}
