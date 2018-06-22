@extends('layout.mainlayout') @section('content') @include('layout.partials.header')
<div class="u-bg-color-shade-200 u-space-between-sections-pd">
    <div class="c-container-blog o-wrapper o-wrapper--l">
            @if (isset($title))
                <h3 style="margin-bottom:30px;font-weight:bold;">{{ $title }}</h3>
            @endif
        <div class="o-grid-auto">
            @foreach($posts as $post)
            <article class="c-post">
                @if ($post->images->count() === 1)
                    <picture><img src="{{ $post->images->first()->url }}" alt="" class="c-post__img">
                    </picture>
                @endif
                <div class="c-post__content">
                    {{-- @if (isset($title))
                        <h3>{{ $title }}</h3>
                    @endif --}}
                    <header class="c-post__header">
                    <div class="c-post__category"><a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></div>
                        <div class="c-post__date">{{$post->published_at->format('M d')}}</div>
                        <h1 class="c-post__title">{{$post->title}}</h1>
                        <div class="c-post__subtitle">
                            {{$post->subtitle}}
                        </div>
                    </header>
                    <p class="c-post__text">{{$post->extract}}</p>
                    <footer class="c-post__footer">
                    <a href="/blog/{{ $post->url }}" class="c-post__link">Leer más</a>
                        <div class="c-post__tags">
                            @foreach($post->tags as $tag)
                        <a href="{{ route('tags.show', $tag) }}">#{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </footer>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>

@endsection

{{ $posts->links() }}

