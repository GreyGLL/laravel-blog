@extends('layout.mainlayout') @section('content') @include('layout.partials.header')

<div class="c-banner-intro">
    <picture class="c-banner-intro__media"> <!-- Los ::after o ::before tienen que ir con etiquetas con cierre -->
        <img src="https://source.unsplash.com/random/1920x1080" class="c-banner-intro__image">
    </picture>
    <div class="c-banner-intro__wrap o-wrapper o-wrapper--xl">
        <h1 class="c-banner-intro__title">Es camí d'es correu</h1>
        <div class="c-banner-intro__buttons">
            <div class="c-banner-intro__icon c-special-icon">
                <span class="c-special-icon__element fas fa-map-marker"></span>
            </div>
            <div class="c-banner-intro__icon c-special-icon">
                <span class="c-special-icon__element fas fa-user"></span>
            </div>

        </div>
    </div>
</div>


@endsection