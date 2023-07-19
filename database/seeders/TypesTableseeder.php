<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (config('types') as $objType) {

            $slug = Type::slugger($objType['name']);
            $project = Type::create([
                'name'          => $objType['name'],
                'slug'          => $slug,
                'description'   => $objType['description'],
            ]);
        };
    }
}
