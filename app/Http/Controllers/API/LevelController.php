<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $data = Levels::latest()->paginate();
        $i = (request()->input('page', 1) - 1) * 5;
        
        return view('posts.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

        return response()->json(['data'=>$data, 'i'=>$i], 200); 
        */

        return Level::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $level = Level::create($request->all());
            return response()->json($level, 201); 
        } catch(\Illuminate\Database\QueryException $ex) {
            return response()->json(['msg'=>'invalid data'], 400); 
        }
        
        // return Level::create($request->all());     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level  $levels
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = Level::find($id);
        if (!$level) return response()->json(['msg'=>'invalid data'], 400);
        try {
            return response()->json($level, 200);
        } catch(\Illuminate\Database\QueryException $ex) {
            return response()->json(['msg'=>'invalid data'], 400); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $levels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $level = Level::find($id);
        if (!$level) return response()->json(['msg'=>'invalid data'], 400);
        try {
            $level->update($request->all());
            return response()->json($level, 200);
        } catch(\Illuminate\Database\QueryException $ex) {
            return response()->json(['msg'=>'invalid data'], 400); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $levels
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::find($id);
        if (!$level) return response()->json(['msg'=>'invalid data'], 400);
        try {
            $level->delete();
            return response()->json(['msg'=>'item deleted'], 204);
        } catch(\Illuminate\Database\QueryException $ex) {
            return response()->json(['msg'=>'invalid data'], 400); 
        }
    }
}
