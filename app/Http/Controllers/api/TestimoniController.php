<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use App\Models\Menu;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
     $testimoni = testimoni::with(['users','menus'])->where('menus_id',$id)->get();
      return $testimoni;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    { 
          $Menu = Menu::where('id',$id)->first();
            $testimoni = new Testimoni;
            $testimoni->users_id = $request->users_id;
            $testimoni->menus_id = $Menu->id;
            $testimoni->comment = $request->comment;
            $testimoni->save();
            return response()->json([
              'status' => 200,
              'data'=>$testimoni
            ],200);
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function show(Testimoni $testimoni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimoni $testimoni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimoni $testimoni)
    {
        //
    }
    public function menuComment($id)
    {
    $CommentMenu = Testimoni::with('menus')->where('id', $id)->get();
    return $CommentMenu;
    }
}
