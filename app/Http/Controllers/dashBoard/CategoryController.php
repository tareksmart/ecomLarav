<?php

namespace App\Http\Controllers\dashBoard;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); //يسحب كل الاقسام عن طريق اموديل
        return view('dashboard.category.index', compact('categories'));
        //       return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = category::all();
        return view('dashboard.category.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { //$request->post('name') معناها هات الداتا اللى جايا من الحقل اللى اسمه
        //name
        // من فورم نوعها
        //post
        //ممكن يكون فى متغير او بارامتر اسمه name فى مكان تانى احنا كده خصصننا
        $request->merge([ //الحاق اى بيانات غير مذكورة بالفورم
            'slug' => Str::slug($request->post('name')) //دالة ال slug بتحذف اى مسافة او علامات مميزة مثل التعجب تخلى كل الحروف كابيتال
            //هنا سجلنا فى حقل ال slug اسم التصنيف مجرد من اى شىء لانه سوف يظهر فى الرابط
            //
        ]);
        //طريقة1
        // $cate=new category($request->all());
        // $cate->save();
        //طريقة2
        $cat = category::create($request->all());
        return redirect()->route('dashboard.category.index')->with('success', 'category added successfully'); //
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
        try {
            $category = category::findOrFail($id);
            //هات كل الاقسام ماعدا القسم اللى انا اديتك ال id بتاعه
            //وخزنه فى المتغير $parents
            //عشان نملى بيه ال كومبوبوكس او هنا اسمه Select
            echo 'suc';
        } catch (Exception $e) {
            echo 'fail';
            return  redirect()->route('dashboard.category.index')->with('info', 'record not found');
        }
        //احضار كل الابهات ماعدا التصنيف المطلوب تعديله وابناء التصنيف المطلوب تعديله
        $parents = category::where('id', '<>', $id)->where('parentId','<>',$id)->get();


        return view('dashboard.category.edit', compact(['category', 'parents']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([ //الحاق اى بيانات غير مذكورة بالفورم
            'slug' => Str::slug($request->post('name')) //دالة ال slug بتحذف اى مسافة او علامات مميزة مثل التعجب تخلى كل الحروف كابيتال
            //هنا سجلنا فى حقل ال slug اسم التصنيف مجرد من اى شىء لانه سوف يظهر فى الرابط
            //
        ]);
        //احضار القسم المراد تعديله

        $category = category::find($id);


        $category->update($request->all()); //ِرط حقول قاعدة البيانات مثل حقول الفورم نفس الاسماء
        return redirect()->route('dashboard.category.index')->with('success', 'category updated successfully');
        //طريقة اخرى للتعديل
        //$category->fill($request->all())->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //طريقة1
        $cate = category::findOrFail($id);
        $cate->delete();
        //طريقة 2
        // category::destroy($id);//يتم حذف السجل بناءا على برمرى كى مع الاعتبار ان البرمرى فى موديل مثل اللى فى الجدول
        return redirect()->route('dashboard.category.index')->with('info', 'category deleted successfully');
    }
}
