<?php

namespace App\Http\Controllers\dashBoard;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    {//$request->post('name') معناها هات الداتا اللى جايا من الحقل اللى اسمه 
        //name
        // من فورم نوعها 
        //post
        //ممكن يكون فى متغير او بارامتر اسمه name فى مكان تانى احنا كده خصصننا
        $request->merge([//الحاق اى بيانات غير مذكورة بالفورم
            'slug'=>Str::slug($request->post('name'))//دالة ال slug بتحذف اى مسافة او علامات مميزة مثل التعجب تخلى كل الحروف كابيتال
            //هنا سجلنا فى حقل ال slug اسم التصنيف مجرد من اى شىء لانه سوف يظهر فى الرابط
            //
        ]);
        //طريقة1
        // $cate=new category($request->all());
        // $cate->save();
        //طريقة2
        $cat=category::create($request->all());
        return redirect()->route('category.index')->with('success','category added successfully');//
        //flash message 
        //with ترسل session الى صفحة ال index
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
