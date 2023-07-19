<?php

namespace Database\Seeders;

use App\Models\Tecnology;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TecnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tecnologies = [
            [
                "name" => "HTML"
            ],
            [
                "name" => "CSS"
            ],
            [
                "name" => "JS"
            ],
            [
                "name" => "VUE"
            ],
            [
                "name" => "PHP"
            ],
            [
                "name" => "BLADE"
            ],
        ];


        // foreach ($tecnologies as $tecnology) {
        //     Tecnology::create($tecnology);
        // }

        foreach ($tecnologies as $objTecnology) {

            $slug = Tecnology::slugger($objTecnology['name']);
            $project = Tecnology::create([
                'name'          => $objTecnology['name'],
                'slug'          => $slug,
            ]);
        };
    }
}
