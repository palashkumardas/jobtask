<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data=DB::table('task')->get();
       return response()->json($data, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|unique:task|max:255',
            'title' => 'required|unique:task|max:255',
            'description' => 'required',
        ]);

        $task= DB::table('task')->insert([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $getdata=DB::table('task')->where('id',$id)->get();
        return response()->json($getdata, 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $update=DB::table('task')->where('id',$id)->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        return response()->json([
            'message' => 'Task updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage...
     */
    public function destroy($id)
    {
        $delete=DB::table('task')->where('id',$id)->delete();
        return response()->json([
            'message' => 'Task deleted successfully'

        ],200);
    }
}
