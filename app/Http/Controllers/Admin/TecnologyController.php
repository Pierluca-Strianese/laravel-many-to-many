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
        //
    }

    public function store(Request $request)
    {
        //
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
    }

    public function destroy($slug)
    {
        $tecnology = Tecnology::where('slug', $slug)->firstOrFail();

        $tecnology->projects()->detach();
        $tecnology->delete();


        return to_route('admin.tecnologies.index')->with('delete_success', $tecnology);
    }
}
