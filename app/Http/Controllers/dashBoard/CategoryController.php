<?php

namespace App\Http\Controllers\dashBoard;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
        $category = new category();
        return view('dashboard.category.create', compact(['parents', 'category']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateForm($request, 0);
        //$request->post('name') معناها هات الداتا اللى جايا من الحقل اللى اسمه
        //name
        // من فورم نوعها
        //post
        //ممكن يكون فى متغير او بارامتر اسمه name فى مكان تانى احنا كده خصصننا
        $request->merge([ //الحاق اى بيانات غير مذكورة بالفورم
            'slug' => Str::slug($request->post('name')) //دالة ال slug بتحذف اى مسافة او علامات مميزة مثل التعجب تخلى كل الحروف كابيتال
            //هنا سجلنا فى حقل ال slug اسم التصنيف مجرد من اى شىء لانه سوف يظهر فى الرابط
            //
        ]);
        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);
        //طريقة1
        // $cate=new category($request->all());
        // $cate->save();
        //طريقة2
        $cat = category::create($data);
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
            return redirect()->route('dashboard.category.index')->with('info', 'record not found');
        }
        //احضار كل الابهات ماعدا التصنيف المطلوب تعديله وابناء التصنيف المطلوب تعديله
        $parents = category::where('id', '<>', $id)->where('parentId', '<>', $id)->get();


        return view('dashboard.category.edit', compact(['category', 'parents']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateForm($request, $id);
        $request->merge([ //الحاق اى بيانات غير مذكورة بالفورم
            'slug' => Str::slug($request->post('name')) //دالة ال slug بتحذف اى مسافة او علامات مميزة مثل التعجب تخلى كل الحروف كابيتال
            //هنا سجلنا فى حقل ال slug اسم التصنيف مجرد من اى شىء لانه سوف يظهر فى الرابط
            //
        ]);
        //احضار القسم المراد تعديله

        $category = category::find($id);
        $data = $request->except('image');

        $path = $this->uploadImage($request);
        //فحص لو مفيش صورة جايه من الريكوست عشان ميعدلش على الفاضى بnull صورة
        if ($path) {
            $data['image'] = $path;
        }


        $oldImage = $category->image;

        $category->update($data); //ِرط حقول قاعدة البيانات مثل حقول الفورم نفس الاسماء
        if ($oldImage && isset($data['image'])) //لوفى صورة جديدة وقديمة احذف القديمه
        {
            Storage::disk('public')->delete($oldImage); //حذف الصورة من ال public
        }
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
        //حذف الصورة من فولدر ابلود
        if ($cate->image) {
            Storage::disk('public')->delete($cate->image);
        }
        //طريقة 2
        // category::destroy($id);//يتم حذف السجل بناءا على برمرى كى مع الاعتبار ان البرمرى فى موديل مثل اللى فى الجدول
        return redirect()->route('dashboard.category.index')->with('info', 'category deleted successfully');
    }

    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return; //لومفيش صورة جايه من الفرونت اطلع
        }
        $file = $request->file('image');
        $path = $file->store('upload', 'public');
        return $path;
    }

    public function validateForm(Request $request, $id)
    {
        //هنا الفالىديت لو حصل exception
// مش هيكمل باقى الاكواد تحت
        //وبيمسح خانات الادخال من الفورمة بيخزنها مؤقتا فى Session
        //ممكن نسحب البينات عن طريق session('session name).get()
        //لكن فى دالة اسمها old بترجع الداتا من الsession
        $request->validate(
            ['name' => ['string', 'required', 'min:3', 'max:255',
                Rule::unique('category', 'name')->ignore($id)],//make name column unique except category that will edited
                'parenId' => ['int', 'exists:category,id'],//لازم id فى جدول التصنيف يكوم موجود
                'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],//نوع صورة- حجم اقل من 1ميجا-ابعاد 100 عرض 100طول اقل حاجة
                'status' => ['in:active,archived',
                    'required']//in عبارة قائمة
            ]
        );//اضافة حقول الفورم

    }
}
