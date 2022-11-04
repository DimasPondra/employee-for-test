<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'address' => '0520 Paget Point',
                'age' => 30,
                'born_date' => '1992-01-11',
                'born_place' => 'Kawengan',
                'gender' => Profile::GENDER_MALE,
                'occupation_id' => 1,
                'user_id' => 1
            ],
            [
                'address' => '8 Mcbride Alley',
                'age' => 35,
                'born_date' => '1987-04-12',
                'born_place' => 'Espinal',
                'gender' => Profile::GENDER_FEMALE,
                'occupation_id' => 2,
                'user_id' => 2
            ],
            [
                'address' => '3994 Butterfield Way',
                'age' => 31,
                'born_date' => '1991-01-31',
                'born_place' => 'Almendra',
                'gender' => Profile::GENDER_MALE,
                'occupation_id' => 4,
                'user_id' => 3
            ],
        ];

        foreach ($profiles as $profile) {
            Profile::create($profile);
        }
    }
}
