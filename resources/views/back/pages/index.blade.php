@extends('back.layouts.master')
@section('title','Tüm sayfalar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold  text-primary">@yield('title')</h6>
            <h6 class="m-0 font-weight-bold float-right text-primary"><strong> {{$pages->count()}}</strong> : Sayfa Bulunudu
            </h6>

        </div>
        <div class="card-body">
            <div id="orderSuccess" style="display:none;" class="alert alert-success">
                Sıralama başarıyla güncellendi.
            </div>
            <div  class="table-responsive">
                <table   class="table table-bordered" id="dataTable"  width="100%"  cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Makakele Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                    @foreach($pages as $page)
                    <tr id="page_{{$page->id}}">
                        <td class="text-center" style="width:5%">
                            <i class="fa fa-arrows-alt-v fa-3x handle" style="cursor:move"></i></td>
                        <td>
                            <img src="{{asset($page->image)}}" width="200">
                        </td>
                        <td>
                            {{$page->title}}
                        </td>
                        <td>    <input class="switch" page-id="{{$page->id}}" type="checkbox" @if($page->status==1 )checked @endif data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"></td>
                        <td>
                            <a target="_blank" href="{{route('page',$page->slug )}}" title="Görüntüle"  class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.page.edit.post',$page->id)}}" title="Düzenle"  class="btn btn-sm btn-primary"><i class="fa fa-pen"></i> </a>
                            <a href="{{route('admin.page.delete',$page->id)}}" title="Sil"  class="btn btn-sm btn-danger"><i class="fa fa-times"></i> </a>

                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.7.0/Sortable.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
    $('#orders').sortable({
        handle:'.handle',
        update:function (){
           var siralama = $('#orders').sortable('serialize');
          $.get("{{route('admin.page.orders')}}?"+siralama,function (data,status){
          $("#orderSuccess").show().delay(1000).fadeOut();
          });
        }
    });
    </script>
    <script>
        $(function() {
            $('.switch').change(function() {
              id = $(this)[0].getAttribute('page-id');
              statu=$(this).prop('checked');
                $.get("{{route('admin.page.switch')}}",{id:id,status:statu}, function(data, status){
                });
            })
        })
    </script>
@endsection
