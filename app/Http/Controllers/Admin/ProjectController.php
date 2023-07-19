<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Tecnology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    private $validations = [
        'title'         => 'required|string|min:4|max:50',
        'type_id'       => 'required|integer|exisist:types,id',
        'author'        => 'required|string|max:30',
        'image'         => 'nullable|image',
        'creation_date' => 'required|date',
        'collaborators' => 'max:150',
        'link_github'   => 'url|max:150',
        'tecnologies'   => 'nullable|array',
        'tecnologies.*' => 'integer|exisist:tecnologies,id',
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

        $imagePath = Storage::put('uploads', $data['image']);

        // Salvare i dati nel database
        $newProject = new Project();
        $newProject->title              = $data['title'];
        $newProject->slug               = Project::slugger($data['title']);
        $newProject->type_id            = $data['type_id'];
        $newProject->author             = $data['author'];
        $newProject->creation_date      = $data['creation_date'];
        $newProject->last_update        = $data['last_update'];
        $newProject->collaborators      = $data['collaborators'];
        $newProject->description        = $data['description'];
        $newProject->image              = $imagePath;
        $newProject->link_github        = $data['link_github'];
        $newProject->save();

        $newProject->tecnologies()->sync($data['tecnologies'] ?? []);


        return to_route('admin.project.show', ['project' => $newProject]);
    }


    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.show', compact('project'));
    }


    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $types          = Type::all();
        $tecnologies    = Tecnology::all();
        return view('admin.projects.edit', compact('project','types','tecnologies'));
    }


    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        // validare i dati
        // $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        if ($project->image) {

            $imagePath = Storage::put('uploads', $data['image']);

            if($project->image) {
                Storage::delete($project->image);
            }

            $project->image = $imagePath;
        }


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


    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->delete();

        return to_route('admin.project.index')->with('delete_success', $project);
    }

    public function restore($slug)
    {
        Project::withTrashed()->where('slug', $slug)->restore();

        $project = Project::find($slug);

        return to_route('admin.project.trashed')->with('restore_success', $project);
    }

    public function trashed()
    {
        // $projects = project::all(); // SELECT * FROM `projects`
        $trashedProjects = Project::onlyTrashed()->paginate(6);

        return view('admin.projects.trashed', compact('trashedProjects'));
    }

    public function harddelete($slug)
    {
        $project = Project::withTrashed()->find($slug);

        if($project->image) {
            Storage::delete($project->image);
        }

        $project->tecnologies()->detach();
        $project->forceDelete();

        return to_route('admin.project.trashed')->with('delete_success', $project);
    }

    public function cancel($slug)
    {
        Project::withTrashed()->where('slug', $slug)->restore();

        $project = Project::find($slug);

        return to_route('admin.project.index')->with('cancel_success', $project);
    }
}
