<?php

namespace Database\Seeders;

use App\Models\FurloughType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FurloughTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $furloughTypes = [
            [
                'name' => 'Annual leave'
            ],
            [
                'name' => 'Marriage leave'
            ],
            [
                'name' => 'Maternity leave'
            ],
            [
                'name' => 'Sick leave'
            ],
        ];

        foreach ($furloughTypes as $furloughType) {
            FurloughType::create($furloughType);
        }
    }
}
