<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return $category;
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
      $category = new Category;
      $category->name_category = $request->name_category;
      $category->slug = Str::slug($request->name_category);
      $category->save();
      return response()->json(['status' =>200,'data'=>$category],200);
    }

   public function detailDataCategory($slug)
   {
    $categoryDetail = Category::where('slug',$slug)->with(['menus'])->get();
    return response()->json(['status' =>200,'data'=>$categoryDetail],200);
   }
   
}
