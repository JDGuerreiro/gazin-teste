<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
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

        return Developer::all();
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
            $developer = Developer::create($request->all());
            return response()->json($developer, 201); 
        } catch(\Illuminate\Database\QueryException $ex) {
            return response()->json(['msg'=>'invalid data'], 400); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Levels  $developers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = Developer::find($id);
        if (!$developer) return response()->json(['msg'=>'invalid data'], 400);
        try {
            return response()->json($developer, 200);
        } catch(\Illuminate\Database\QueryException $ex) {
            return response()->json(['msg'=>'invalid data'], 400); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Levels  $developers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $developer = Developer::find($id);
        if (!$developer) return response()->json(['msg'=>'invalid data'], 400);
        try {
            $developer->update($request->all());
            return response()->json($developer, 200);
        } catch(\Illuminate\Database\QueryException $ex) {
            return response()->json(['msg'=>'invalid data'], 400); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Levels  $developers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developer = Developer::find($id);
        if (!$developer) return response()->json(['msg'=>'invalid data'], 400);
        try {
            $developer->delete();
            return response()->json(['msg'=>'item deleted'], 204);
        } catch(\Illuminate\Database\QueryException $ex) {
            return response()->json(['msg'=>'invalid data'], 400); 
        }
    }
}
