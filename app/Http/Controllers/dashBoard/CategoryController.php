<?php

namespace App\Http\Controllers\dashBoard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\get;
use App\Http\Requests\categoryRequest;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use mysql_xdevapi\Exception;
use PharIo\Manifest\Url;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //request() تسجب الركويست اللى جاى من مثلا البحث اوالفلتر
        //query() تسحب البارامترات اللى فى ال يوار ال
        $request=request();//  ثم الكويرى 
    
        $query=category::query();//كاننا عملنا كويرى من جدول الافسام بس لسه لم نضع الشروط
        // if($name=$request->query('name')){
        //     $query->where('name','LIKE',"%{$name}%");
        // }
        // if($status=$request->query('status')){
        //     $query->where('status','=',$status);
        // }
    
        // $categories = Category::all(); //يسحب كل الاقسام عن طريق اموديل
        // $categories = Category::paginate(2);//سحب قسمين
    //    $categories=$query->paginate(4);
        // $categories=category::status($request->query('status'))->paginate(2);//locale scope
        //$request->query() بترجع مصفوفة من البارمترات اللى موجوده فى ال url
        //تم عمل جوين لنفس الجدول باستخدام الياس
        //لفهمهافديو Eloquent Model Local Scopes
        //جملة ال سى كوال المنقذه
          // SELECT a.*, b.name as parent_name
        // FROM categories as a
        // LEFT JOIN categories as b ON b.id = a.parent_id
        $categories=category::leftJoin('category as parents','parents.id','=','category.parentId')->
        select([
            'category.*','parents.name as parent_name'
        ])->

        
        filter($request->query())->orderBy('category.name','desc')->paginate(3);
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
        /*هنا اللى راجع الحقول اللى اتعمل ليها فلترة فقط لكن حقل مثل
        discription
        مش هيرجع */
        $cleanData=$request->validate( category::rules(0),[
           // 'required'=>'this field [:attribute] is wanted',//هنا بنغير الرسالة اللى بتظهر لو فى حق اتبعت فاضى رساله خاصة غير المتسجلة بلارافيل
            'name.unique'=>'this name already exists'//'هنا بنضع رسالة خاصة بالفلتر يونيك للحقل نيم فقط بنحدد لحقل معين'
        ]);
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
            //echo 'suc';
        } catch (Exception $e) {
            echo 'fail';
            return redirect()->route('dashboard.category.index')->with('info', 'record not found');
        }
        //احضار كل الابهات ماعدا التصنيف المطلوب تعديله وابناء التصنيف المطلوب تعديله
        //واحضار كل الابهات اللى ملهاش اب يعنى قيمته نل
        //use($id) لتمرير المتغير داخل الكلوجر فانكشن
        //استخدام الكلوجر فانكشن لعمل قوس الشروط الاخرى
        //where->where معناها حيث كذا اند كذا لان كلمة اند لاتكتب  لكن اور تكتب
        // // SELECT * FROM categories WHERE id <> $id 
        // AND (parent_id IS NULL OR parent_id <> $id)
        $parents = category::where('id', '<>', $id)->where(function($query) use ($id){
            $query->whereNull('parentId')->orWhere('parentId', '<>', $id);
        })->get();
        


        return view('dashboard.category.edit', compact(['category', 'parents']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoryRequest $request, string $id)//categoryRequest ريكوست مخصوص
    {
        //$cleanData=$request->validate( category::rules($id));

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


}
