@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRusZy4IY0D_svzYuxn6BPl_m1la9v3PK00nA&usqp=CAU' )
@section('content')
    <div class="col-md-10 col-lg-8 col-xl-7">
        @if(session('success'))
        <div class="alert alert-success">
         {{session('success')}}
        </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $errors)
                        <li>{{$errors}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    <p>Bizimle İletişime Geçebilirsiniz.</p>
    <div class="my-5">
        <form method="post" action="{{route('contact.post')}}">
            @csrf
            <div class="control-group">
            <div class="form-group controls">
                <label>Ad Soyad</label>
                <input class="form-control"  type="text" value="{{old('name')}}" placeholder="Ad Soyadınız" name="name"  required />

            </div>
            </div>
            <div class="control-group">
                <div class="form-group controls">
                <label>Email Adresi</label>
                <input class="form-control"  type="email" value="{{old('email')}}" name="email" placeholder="Email Adresiniz" required />

                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12 controls">
                <label>Konu</label>
                <select class="form-control" name="topic">
                    <option @if(old('topic)=="Bilgi") selected @endif> Bilgi</option>
                    <option @if(old('topic')=="Destek") selected @endif >Destek</option>
                    <option @if(old('topic')=="Genel") selected @endif >Genel</option>
                </select>
            </div>
                <div class="control-group">
                    <div class="form-group controls">
                        <label for="message">Mesajınız</label>
                <textarea class="form-control" name="message" placeholder="Mesajınız" style="height: 12rem" required> {{old('message')}}</textarea>

                    </div>
            </div>
            </div>
            <br />
           <div id="success"></div>
                <div class="form-group">
            <button class="btn btn-primary" id="sendMessageButton" type="submit">Gönder</button>
                </div>

        </form>
    </div>
@endsection



