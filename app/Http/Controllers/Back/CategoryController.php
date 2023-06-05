<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Article;


class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('back.categories.index',compact('categories'));
    }

    public function create(Request $request){
        $isExist=Category::whereSlug(str::Slug($request->category))->first();
        if($isExist){
            toastr()->warning($request->category.' adında kategori  zaten mevcut!','Hata!');
            return redirect()->back();
        }
     $category = new Category;
     $category->name=$request->category;
     $category->slug=str::Slug($request->category);
     $category->save();
     toastr()->success('Kategori Başarıyla Oluşturuldu','Başarılı');
     return redirect()->back();
    }
    public function update(Request $request){
        $isSlug=Category::whereSlug(str::Slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName=Category::whereName($request->category)->whereNotIn('id',[$request])->first();
        if($isSlug or $isName){
            toastr()->error($request->category.' adında kategori  zaten mevcut!','Hata!');
            return redirect()->back();
        }

        $category =Category::find($request->id);
        $category->name=$request->category;
        $category->slug=str::Slug($request->slug);
        $category->save();
        toastr()->success('Kategori Başarıyla değiştirildi.)','Başarılı');
        return redirect()->route('admin.dashboard');
    }
    public function delete(Request $request){
        $category = Category::findOrFail($request->id);
        if($category->id==1){
            toastr()->warning('Bu kategori silinemez! ','Başarılı');
            return redirect()->back();
        }
        $message ='';
        $count = $category->articleCount();
        if($count>0){
            $defaultCategory=Category::find(1);
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $defaultCategory=Category::find(1);
            $message =  'Bu kategoriye ait ' .$count.' makale '.$defaultCategory->name.' kategorisine taşındı.';
        }
        $category->delete();
        toastr()->success($message,'Kategori başarıyla silindi');
        return redirect()->back();
    }

    public function getData(Request $request){
        $category = Category::findOrFail($request->id);
        return response()->json($category);
       }


    public function switch(Request $request){
        $category = Category::findOrFail($request->id);
        $category->status=$request->statu=='true' ? 1 : 0 ;
        $category->save();
    }
}
