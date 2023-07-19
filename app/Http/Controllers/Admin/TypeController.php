<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    private $validations = [
        'name'         => 'required|string|max:50',
        'description'  => 'required|string|max:1000',
    ];

    public function index()
    {
        $types = Type::all();
        return view ('admin.types.index', compact('types'));
    }

    public function create()
    {
        return view('Admin.types.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->validations);
        $data = $request->all();

        // Salvare i dati nel database
        $newType = new Type();
        $newType->name          = $data['name'];
        $newType->slug          = Type::slugger($data['name']);
        $newType->description   = $data['description'];
        $newType->save();

        return redirect()->route('admin.types.show', ['type' => $newType]);
    }

    public function show($slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        return view ('admin.types.show', compact('type'));
    }

    public function edit($slug)
    {
         $type = Type::where('slug', $slug)->firstOrFail();
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        $request->validate($this->validations);
        $data = $request->all();

        // Salvare i dati nel database
        $type->name = $data['name'];
        $type->description = $data['description'];
        $type->update();

        return redirect()->route('admin.types.show', ['type' => $type]);
    }

    public function destroy($slug)
    {

        $type = Type::where('slug', $slug)->firstOrFail();

        foreach ($type->projects as $type) {
            $project->category_id = 1;
            $project->update();
        }

        $type->delete();

        return to_route('admin.types.index')->with('delete_success', $type);
    }
}
