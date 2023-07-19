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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view ('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        return view ('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
         $type = Type::where('slug', $slug)->firstOrFail();
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
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
