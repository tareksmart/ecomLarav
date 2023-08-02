<?php

namespace App\Http\Controllers\dashBoard;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $categories=Category::all();//يسحب كل الاقسام عن طريق اموديل
  return view('dashboard.category.index',compact('categories'));
//       return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents=category::all();
        return view('dashboard.category.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //طريقة1
        // $cate=new category($request->all());
        // $cate->save();
        //طريقة2
        $cat=category::create($request->all());
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
