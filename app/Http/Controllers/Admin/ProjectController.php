<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->get();
        //dd($projects);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        //dd($types);
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request->all());

        $val_data = $request->validated();

        if ($request->hasFile('thumb')) {
            $thumb = Storage::put('uploads', $val_data['thumb']);
            //dd($thumb);
            $val_data['thumb'] = $thumb;
        }

        $project_slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $project_slug;

        $project = Project::create($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->attach($val_data['technologies']);
        }


        return to_route('admin.projects.index')->with('message', "$project->title added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        if ($request->hasFile('thumb')) {
            if ($project->thumb) {
                Storage::delete($project->thumb);
            }

            $thumb = Storage::put('uploads', $val_data['thumb']);
            //dd($thumb);
            $val_data['thumb'] = $thumb;
        }

        $project_slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $project_slug;

        $project->update($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return to_route('admin.projects.index')->with('message', "$project->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->thumb) {
            Storage::delete($project->thumb);
        }

        $project->delete();

        return to_route('admin.projects.index')->with('message', "$project->title deleted successfully");
    }
}
