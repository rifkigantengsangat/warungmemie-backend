<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $menu = Menu::get();
      return response()->json(['status'=>200,'data'=>$menu]);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'=> 'required|mimes:jpeg,png,jpg'
        ]);
        if($validator->fails()){
            return response()->json(['status' =>402,'error'=>$validator->errors()]);
        }
        $menus = new Menu;
        $menus->category_id = $request->category_id;
        $menus->nama = $request->nama;
        $menus->harga = $request->harga;
        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$filename);
        $menus->image=$filename;
        $menus->save();
        return response()->json(['status'=>200,'data'=>$menus]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(menu $menu)
    {
        //
    }
   
}
