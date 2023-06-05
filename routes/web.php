<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\PageController;
use Illuminate\Support\Facades\Route;




//backend routes

Route::get('site-bakimda',function (){
    return view('front.offline');
});

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function() {
    Route::get('giris', [App\Http\Controllers\Back\AuthController::class, 'login'])->name('login');
    Route::post('giris', [App\Http\Controllers\Back\AuthController::class, 'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel',[App\Http\Controllers\Back\Dashboard::class,'index'])->name('dashboard');
    // makale route
    Route::get('makaleler/silinenler',[ArticleController::class,'trashed'])->name('trashed.article');
    Route::resource('makaleler', ArticleController::class);
    Route::get('/switch',[ArticleController::class,'switch'])->name('switch');
    Route::get('/deletearticle/{id}',[ArticleController::class,'delete'])->name('delete.article');
    Route::get('/harddeletearticle/{id}',[ArticleController::class,'hardDelete'])->name('hard.delete.article');
    Route::get('/recoverarticle/{id}',[ArticleController::class,'recover'])->name('recover.article');
    //kategori route
    Route::get('/kategoriler',[App\Http\Controllers\Back\CategoryController::class,'index'])->name('category.index');
    Route::post('/kategoriler/create',[App\Http\Controllers\Back\CategoryController::class,'create'])->name('category.create');
    Route::post('/kategoriler/update',[App\Http\Controllers\Back\CategoryController::class,'update'])->name('category.update');
    Route::post('/kategoriler/delete',[App\Http\Controllers\Back\CategoryController::class,'delete'])->name('category.delete');
    Route::get('/kategori/status',[App\Http\Controllers\Back\CategoryController::class,'switch'])->name('category.switch');
    Route::get('/kategori/getData',[App\Http\Controllers\Back\CategoryController::class,'getData'])->name('category.getdata');
// page route
    Route::get('/sayfalar',[App\Http\Controllers\Back\PageController::class,'index'])->name('page.index');
    Route::get('/sayfalar/olustur',[App\Http\Controllers\Back\PageController::class,'create'])->name('page.create');
    Route::post('/sayfalar/olustur',[App\Http\Controllers\Back\PageController::class,'post'])->name('page.create');
    Route::post('/sayfalar/guncelle/{id}',[App\Http\Controllers\Back\PageController::class,'updatePost'])->name('page.edit.post');
    Route::get('/sayfalar/guncelle/{id}',[App\Http\Controllers\Back\PageController::class,'update'])->name('page.edit.post');
    Route::get('/sayfa/switch',[PageController::class,'switch'])->name('page.switch');
    Route::get('/sayfa/sil/{id}',[App\Http\Controllers\Back\PageController::class,'delete'])->name('page.delete');
    Route::get('/order/siralama',[App\Http\Controllers\Back\PageController::class,'orders'])->name('page.orders');
    //Configs route
    Route::get('/ayarlar',[App\Http\Controllers\Back\ConfigController::class,'index'])->name('config.index');
    Route::post('/ayarlar/update',[App\Http\Controllers\Back\ConfigController::class,'update'])->name('config.update');

    //
    Route::get('cikis',[App\Http\Controllers\Back\AuthController::class,'logout'])->name('logout');



});



//front routes


Route::get('/',[App\Http\Controllers\Front\Homepage::class,'index'])->name('homepage');
Route::get('sayfa',[App\Http\Controllers\Front\Homepage::class,'index']);
Route::get('/iletisim',[App\Http\Controllers\Front\Homepage::class,'contact'])->name('contact');
Route::post('/iletişim',[App\Http\Controllers\Front\Homepage::class,'contactpost'])->name('contact.post');
Route::get('/kategori/{category}',[\App\Http\Controllers\Front\Homepage::class,'category'])->name('category');
Route::get('/{category}/{slug}',[App\Http\Controllers\Front\Homepage::class,'single'])->name('single');
Route::get('/{sayfa}',[App\Http\Controllers\Front\Homepage::class,'page'])->name('page');


