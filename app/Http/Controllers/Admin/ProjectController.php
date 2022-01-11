<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Media;
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
        $projects = Project::join('users','projects.manager_id','=','users.id')
        ->get(['projects.*', 'users.name']);
        return view('admin.projects.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = User::where('role',1)->get();
        return view('admin.projects.add', compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('thumbnail')) {
            $project = Project::create([
                'name'  => $request->name,
                'address' => $request->address,
                'manager_id' => $request->manager
            ]);
            foreach($request->thumbnail as $image) {
                $name = $image->getClientOriginalName();
                $image->storeAs('/public/images/projects', $name);
                $project->image()->create(["image_src" => "images/projects/". $name]);
            }
            return redirect()->route('project.list')->withInput()->with("success", "Lưu thành công");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $managers = User::where('role',1)->get();
        return view('admin.projects.edit', compact('project', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->address = $request->address;
        // image progressing
        $delete_images_src = [];
        if($request->has('thumbnail_src')) {
            foreach($project->image as $project_thumbnail_src) {
                $is_delete = true;
                foreach($request->thumbnail_src as $request_thumbnail_src) {
                    if(trim($project_thumbnail_src->image_src) == trim($request_thumbnail_src)) {
                        $is_delete = false;
                        break;
                    }
                }
                if($is_delete) {
                    array_push($delete_images_src, $project_thumbnail_src->image_src);
                }
            }
        } else {
            foreach($project->image as $project_thumbnail_src) {
                array_push($delete_images_src, $project_thumbnail_src->image_src);
            }
        }
        Media::whereIn("image_src", $delete_images_src)->delete();
        foreach($delete_images_src as $product_thumbnail_src) {
            Storage::delete("images/products/$product_thumbnail_src");
        }
        if($request->has('thumbnail')) {
            foreach($request->thumbnail as $image) {
                $name = $image->getClientOriginalName();
                $image->storeAs('/public/images/projects', $name);
                $project->image()->create(["image_src" => "images/projects/". $name]);
            }
        }
        $project->save();
        return redirect()->route('project.list')->with("success","Sửa thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('project.list')->with("success","Xóa thành công");
    }

    public function updateStatus($id, $status)
    {
        Project::where('id', $id)->update(['status' => $status]);
        return redirect()->route('project.list')->with("success","Cập nhật thành công");
    }
}