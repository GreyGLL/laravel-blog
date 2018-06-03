@extends('layout.mainlayout') @section('content') @include('layout.partials.header')
<div class="u-bg-color-shade-200 u-space-between-sections-pd">
    <div class="c-container-blog o-wrapper o-wrapper--l">
        <div class="o-grid-auto">
            @for ($i = 0; $i < 5; $i++)
            @foreach($posts as $post)
            <article class="c-post">
                <picture>
                    <img src="https://source.unsplash.com/random/1200x60{{$i}}" alt="" class="c-post__img">
                </picture>
                <div class="c-post__content">
                    <header class="c-post__header">
                        <div class="c-post__category">{{$post->category->name}}</div>
                        <div class="c-post__date">{{$post->published_at->format('M dpj')}}</div>
                        <h1 class="c-post__title">{{$post->title}}</h1>
                        <div class="c-post__subtitle">
                            {{$post->subtitle}}
                        </div>
                    </header>
                    <p class="c-post__text">{{$post->extract}}</p>
                    <footer class="c-post__footer">
                        <a class="c-post__link">Leer más</a>
                        <div class="c-post__tags">
                            @foreach($post->tags as $tag)
                            <a href="#">#{{$tag->name}}</a>
                            @endforeach
                            <a href="#">Diversión</a>
                            <a href="#">Salud</a>
                            <a href="#">Fitness</a>
                        </div>
                    </footer>
                </div>
            </article>
            @endforeach
            @endfor
        </div>
    </div>
</div>

@endsection
