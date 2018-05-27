@extends('layout.mainlayout') @section('content') @include('layout.partials.header')

<!--<div class="c-input">
    <div class="c-input__wrapper">
        <input type="search" class="c-input__element c-input__element--has-icon" placeholder="Hello!">
        <div class="c-input__icon">
            <span class="fas fa-search"></span>
        </div>
    </div>
</div>-->

<iframe class="c-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3075.021353591235!2d2.6571692156529445!3d39.58166911392331!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x129793003ce74d0d%3A0x9c1ea6320996528e!2sCalle+de+Pons+y+Gallarza%2C+19%2C+07004+Palma+de+Mallorca%2C+Islas+Baleares!5e0!3m2!1ses!2ses!4v1525541132940" frameborder="0" style="border:0" allowfullscreen></iframe>
<div class="c-search">
    <div class="c-search__wrap o-wrapper o-wrapper--xl"> <!-- tenemos que aplicar un fondo diferente a la web completa, por lo que creamos un contener c-wrap que tendrá los estilos o-wrapper y el modificador xl para determinar el tamaño del contendor (1400px) -->
        <div class="c-search__item">
            <div class="c-input">
                <div class="c-input__wrapper">
                    <input type="search" class="c-input__element c-input__element--has-icon-right" placeholder="Buscar ruta...">
                </div>
            </div>
        </div>
        <div class="c-search__item">
            <div class="c-input">
                <div class="c-input__wrapper">
                    <select class="c-input__element c-input__element--has-icon-right" name="" id="">
                        <option>Uno</option>
                        <option>Dos</option>
                        <option>Tres</option>
                    </select>
                    <div class="c-input__icon c-input__icon--right">
                        <span class="fas fa-angle-down"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-search__item">
            <div class="c-input">
                <div class="c-input__wrapper">
                    <select class="c-input__element c-input__element--has-icon-right" name="" id="">
                        <option>Uno</option>
                        <option>Dos</option>
                        <option>Tres</option>
                    </select>
                    <div class="c-input__icon c-input__icon--right">
                        <span class="fas fa-angle-down"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-search__item">
            <div class="c-input">
                <div class="c-input__wrapper">
                    <select class="c-input__element c-input__element--has-icon-right" name="" id="">
                        <option>Uno</option>
                        <option>Dos</option>
                        <option>Tres</option>
                    </select>
                    <div class="c-input__icon c-input__icon--right">
                        <span class="fas fa-angle-down"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-search__item">
            <button class="c-button c-button--square c-button--full">Buscar</button>
        </div>
    </div>
</div>
<div class="u-bg-color-shade-200 u-space-between-sections-pd">
    <main class="o-wrapper o-wrapper--xl">
        <div class="o-grid-auto">
            @for ($i = 0; $i < 10; $i++)
            <article class="c-card">
                <a href="#"><picture class="c-card__media">
                    <img src="https://source.unsplash.com/random/600x40{{$i}}" alt="" class="c-card__img">
                </picture></a>
                <div class="c-card__box">
                    <h2 class="c-card__title">
                        <a href="#"> Lorem ipsum dolor sit amet consectetur adipisicing elit</a>
                    </h2>
                    <p class="c-card__desc">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis earum quod...
                    </p>
                    <ul class="c-card__info">
                        <li class="c-card__info-item">
                            <span>Distancia:</span> 14,96 km
                        </li>
                        <li class="c-card__info-item">
                            <span>Duración:</span> 2 horas approx.
                        </li>
                        <li class="c-card__info-item">
                            <span>Dificultad:</span> Moderada
                        </li>
                        <li class="c-card__info-item">
                            <span>Zona:</span> La hermita
                        </li>
                    </ul>
                    <div class="c-card__users">
                        <div class="c-card__comments">
                            33 comentarios
                        </div>
                        <div class="c-card__user">
                            <a href="#" class="c-user-link">
                                <img src="https://source.unsplash.com/random/100x100" class="c-user-link__img"><span class="c-user-link__text">Pepito García</span>
                            </a>
                        </div>
                    </div>




                </div>
                </article>
                @endfor
        </div>
    </main>
</div>

@endsection