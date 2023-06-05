@extends('front.layouts.master')

@section('title',$category->name.'    Kategorisi | '  .count($articles).  ' Yazı bulundu.' )

@section('content')
    <div class="col-md-8 col-lg-4 col-xl-7">
       @include('front.widgets.articlelist')
    </div>
    @include('front.widgets.categoryWidget')

@endsection

