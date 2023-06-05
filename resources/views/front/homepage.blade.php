@extends('front.layouts.master')

@section('title', 'Anasayfa')

@section('content')
        <div class="col-md-8 col-lg-4 col-xl-7">
@include('front.widgets.articlelist')
        </div>
       @include('front.widgets.categoryWidget')

@endsection

