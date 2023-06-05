
@if(count($articles)>0)
@foreach($articles as $article)
    <!-- Post preview-->
    <div class="post-preview">
        <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
            <h2 class="post-title">
                {{$article->title}}
            </h2>
            <img src="{{$article->image}}"/>
            <h3 class="post-subtitle">

                {!!   Str::limit($article->content, 75) !!}
            </h3>
        </a>
        <p class="post-meta">Kategori :
            <a href="#!">{{$article->getCategory->name}}</a>
            {{$article->created_at}}
            <span class="float-end">{{$article->created_at->diffForHumans()}}</span>
        </p>
        @if(!$loop->last)
            <hr class="my-4" />
        @endif
    </div>
@endforeach
<div class="d-flex justify-content-center">{{ $articles->links() }} </div>
@else
<div class="alert alert-danger ">
    <h1>Bu kategoriye ait yazı bulunamadı.</h1>
</div>
@endif
