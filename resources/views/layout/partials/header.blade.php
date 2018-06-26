<header class="c-header">
    <div class="c-header__wrap o-wrapper o-wrapper--xl">
        <div class="c-header__logo">
            Kaizen Fitness
        </div>
        <nav class="c-header__menu js-nav-menu">
            <ul class="c-header__list">
                <li class="c-header__item">
                    <a class="c-header__link" href="#">Blog</a>
                </li>
                <li class="c-header__item">
                    <a class="c-header__link" href="#">Sobre nosotros</a>
                </li>
                <li class="c-header__item">
                    <a class="c-header__link" href="#">Contacto</a>
                </li>
            </ul>
        </nav>
        <ul class="c-selector">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="c-selector__item">
                    <a class="c-selector__link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <button class="c-header__toggle-menu js-nav-toggle">
            <span class="fas fa-bars"></span>
        </button>
    </div>

</header>