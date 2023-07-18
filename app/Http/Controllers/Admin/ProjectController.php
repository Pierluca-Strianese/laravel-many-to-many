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
        'languages'     => 'max:50',
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
        $request->validate($this->validations, $this->validation_messages);
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
        $newProject->languages          = $data['languages'];
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
        return view('admin.projects.edit', compact('project','types', 'Tecnology'));
    }


    public function update(Request $request, Project $project)
    {
        // validare i dati
        $request->validate($this->validations, $this->validation_messages);
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
        $newProject->languages          = $data['languages'];
        $newProject->link_github        = $data['link_github'];
        $newProject->update();

        return to_route('admin.project.show', ['project' => $newProject]);
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
