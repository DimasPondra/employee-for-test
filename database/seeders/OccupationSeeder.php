<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $occupations = [
            [
                'name' => 'Design Engineer'
            ],
            [
                'name' => 'Account Coordinator'
            ],
            [
                'name' => 'Senior Quality Engineer'
            ],
            [
                'name' => 'Human Resource Development'
            ],
        ];

        foreach ($occupations as $occupation) {
            Occupation::create($occupation);
        }
    }
}
