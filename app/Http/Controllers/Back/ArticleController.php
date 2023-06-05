<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use newrelic\DistributedTracePayload;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles=Article::orderby('created_at','ASC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $article=new Article;
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->icerik;
        $article->slug=Str::slug($request->title);
        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image='/uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı!', 'Makale başarıyla oluşturuldu');

        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article=Article::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.update',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
            'content'=>'min:10',
        ]);

        $article= Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->icerik;
        $article->slug = Str::slug($request->title);

        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image='/uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı!', 'Makale başarıyla güncellendi');

        return redirect()->route('admin.makaleler.index');
    }
    public  function switch(Request $request){
          $article=Article::findOrFail($request->id);
          $article->status=$request->statu=='true' ? 1 : 0 ;
          $article->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id){
        Article::find($id)->delete();
        toastr()->success('Makale Başarılı şekilde silinen makalelere taşındı','Başarılı');
        return redirect()->route('admin.makaleler.index');

    }
    public function trashed(){
        $articles= Article::onlyTrashed()->orderby('deleted_at','DESC')->get();
    return view('back.articles.trashed',compact('articles'));
    }
    public function recover($id){
        Article::onlyTrashed()->find($id)->restore();
        toastr()->success('Makale Başarılı şekilde geri yüklendi','Başarılı');
        return redirect()->back();

    }
    public function hardDelete($id){
        $article=Article::onlyTrashed()->find($id);
        if(File::exists($article->image)){
            File::delete(public_path($article->image));
        }
        $article->forceDelete();
        toastr()->success('Makale Başarılı şekilde silindi','Başarılı');
        return redirect()->route('admin.makaleler.index');

    }
    public function destroy(string $id)
    {
    }
}
