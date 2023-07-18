<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Tecnology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    private $validations = [
        'title'         => 'required|string|min:4|max:50',
        'type_id'       => 'required|exisist:types,id',
        'author'        => 'required|string|max:30',
        'creation_date' => 'required|date',
        'collaborators' => 'max:150',
        'link_github'   => 'required|url|max:150',
    ];

    private $validation_messages = [
        'title.required'    => 'Il campo titolo è obbligatorio'
    ];


    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }


    public function create()
    {
        $types          = Type::all();
        $tecnologies    = Tecnology::all();
        return view('admin.projects.create', compact('types','tecnologies'));
    }


    public function store(Request $request)
    {
        // validare i dati
        // $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        // Salvare i dati nel database
        $newProject = new Project();
        $newProject->title              = $data['title'];
        $newProject->type_id            = $data['type_id'];
        $newProject->author             = $data['author'];
        $newProject->creation_date      = $data['creation_date'];
        $newProject->last_update        = $data['last_update'];
        $newProject->collaborators      = $data['collaborators'];
        $newProject->description        = $data['description'];
        $newProject->link_github        = $data['link_github'];
        $newProject->save();

        $newProject->tecnologies()->sync($data['tecnologies'] ?? []);


        return to_route('admin.project.show', ['project' => $newProject]);
    }


    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }


    public function edit(Project $project)
    {
        $types          = Type::all();
        $tecnologies    = Tecnology::all();
        return view('admin.projects.edit', compact('project','types','tecnologies'));
    }


    public function update(Request $request, Project $project)
    {
        // validare i dati
        // $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        // Aggiornare i dati nel database
        $project->title              = $data['title'];
        $project->type_id            = $data['type_id'];
        $project->author             = $data['author'];
        $project->creation_date      = $data['creation_date'];
        $project->last_update        = $data['last_update'];
        $project->collaborators      = $data['collaborators'];
        $project->description        = $data['description'];
        $project->link_github        = $data['link_github'];
        $project->update();

        $project->tecnologies()->sync($data['tecnologies'] ?? []);

        return to_route('admin.project.show', ['project' => $project]);
    }


    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.project.index')->with('delete_success', $project);
    }

    public function restore($id)
    {
        Project::withTrashed()->where('id', $id)->restore();

        $project = Project::find($id);

        return to_route('admin.project.trashed')->with('restore_success', $project);
    }

    public function trashed()
    {
        // $projects = project::all(); // SELECT * FROM `projects`
        $trashedProjects = Project::onlyTrashed()->paginate(6);

        return view('admin.projects.trashed', compact('trashedProjects'));
    }

    public function harddelete($id)
    {
        $project = Project::withTrashed()->find($id);
        $project->tecnologies()->detach();
        $project->forceDelete();

        return to_route('admin.project.trashed')->with('delete_success', $project);
    }

    public function cancel($id)
    {
        Project::withTrashed()->where('id', $id)->restore();

        $project = Project::find($id);

        return to_route('admin.project.index')->with('cancel_success', $project);
    }
}
