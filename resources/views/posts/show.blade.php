@extends('layout.mainlayout') @section('content') @include('layout.partials.header')

@section('meta-title',$post->title)
@section('meta-description',$post->extract)
@section('content')
<div class="u-bg-color-shade-200 u-space-between-sections-pd">
    <div class="c-container-blog o-wrapper o-wrapper--l">
        <div class="o-grid-auto">
            <article class="c-post">
                @if ($post->images->count() === 1)
                    <picture><img src="{{ $post->images->first()->url }}" alt="" class="c-post__img">
                    </picture>
                @endif
                    <div class="c-post__content">
                        <header class="c-post__header">
                            <div class="c-post__category"><a href="#">{{$post->category->name}}</div>
                            <div class="c-post__date">{{$post->published_at->format('M d')}}</div>
                            <h1 class="c-post__title">{{$post->title}}</h1>
                            <div class="c-post__subtitle">
                                {{$post->subtitle}}
                            </div>
                        </header>
                        <p class="c-post__text">{!! $post->content !!}</p>
                        <footer class="c-post__footer">
                            <div class="c-post__tags">
                                @foreach($post->tags as $tag)
                                    <a href="#">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </footer>
                    </div>
                </article>
            </div>
        </div>
    </div>

@endsection

<script>
$(document).ready(function(){
    let url = [];
    @foreach($url as $translatedUrl)
        url.push({{ $translatedUrl }});
    @endforeach
    let html = "";
    url.each(function(index, item){
        html += `<li class="c-selector__item">
            <a class="c-selector__link" rel="alternate" href="${item}"></a>
        </li>`;
    });
    $("ul.c-selector").html(html);
});
</script>