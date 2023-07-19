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

            $slug = Project::slugger($objProject['title']);
            $project = Project::create([
                'title'         => $objProject['title'],
                'slug'          => $slug,
                'author'        => $objProject['author'],
                'creation_date' => $objProject['creation_date'],
                'last_update'   => $objProject['last_update'],
                'collaborators' => $objProject['collaborators'],
                'description'   => $objProject['description'],
                'link_github'   => $objProject['link_github'],
                'type_id'       => $objProject['type_id'],
            ]);

            $project->tecnologies()->sync([rand(1,5),rand(1,5),rand(1,5)]);
        };


    }
}
