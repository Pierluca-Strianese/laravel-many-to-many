<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tecnology;
use Illuminate\Http\Request;

class TecnologyController extends Controller
{
    public function index()
    {
        $tecnologies = Tecnology::all();
        return view ('admin.tecnologies.index', compact('tecnologies'));
    }

    public function create()
    {
        return view('admin.tecnologies.create');
    }

    public function store(Request $request)
    {
        // $request->validate($this->validations);
        $data = $request->all();

        // Salvare i dati nel database
        $newtecnology = new tecnology();
        $newtecnology->name          = $data['name'];
        $newtecnology->slug          = Tecnology::slugger($data['name']);
        $newtecnology->save();

        return redirect()->route('admin.tecnologies.index', ['tecnology' => $newtecnology]);
    }

    public function show($slug)
    {
        //
    }

    public function edit($slug)
    {
        $tecnology = Tecnology::where('slug', $slug)->firstOrFail();
        return view('admin.tecnologies.edit', compact('tecnology'));
    }

    public function update(Request $request, $slug)
    {
        $tecnology = Tecnology::where('slug', $slug)->firstOrFail();
        // $request->validate($this->validations);
        $data = $request->all();

        // Salvare i dati nel database
        $tecnology->name = $data['name'];
        $tecnology->update();

        return redirect()->route('admin.tecnologies.index', ['tecnology' => $tecnology]);
    }

    public function destroy($slug)
    {
        $tecnology = Tecnology::where('slug', $slug)->firstOrFail();

        $tecnology->projects()->detach();
        $tecnology->delete();


        return to_route('admin.tecnologies.index')->with('delete_success', $tecnology);
    }
}
