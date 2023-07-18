<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tecnology;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tecnologies = Tecnology::all();

        foreach (config('projects') as $objProject) {
            $project = Project::create($objProject);

            $project->tecnologies()->sync([rand(1,5),rand(1,5),rand(1,5)]);
        };


    }
}
