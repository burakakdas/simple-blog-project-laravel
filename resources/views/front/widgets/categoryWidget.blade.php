@isset($categories)
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>

        <div class="list-group">
            @foreach($categories as $category)

                <a href="{{route('category',$category->slug)}}" class="list-group-item d-flex justify-content-between align-items-center
                @if(Request::segment(2)==$category->slug)
                active @endif">{{$category->name}}
                    <span class="badge  bg-dark"> {{$category->articleCount()}}</span></a>

            @endforeach
        </div>
    </div>

</div>
@endif

