<?php

use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Category::truncate();
        Tag::truncate();
        $category = new Category;
        $category->name = "Fitness";
        $category->save();


        $post = new Post;
        $post->title ="Comenzar a entrenar Crossfit";
        $post->url =str_slug("Comenzar a entrenar Crossfit");
        $post->subtitle ="Una guía para todo aquel que esté pensando en adentrarse en la práctica de esta modalidad";
        $post->extract = "El Crossfit es un deporte extremadamente duro, y aunque se ha publicitado como una nueva opción abierta a cualquier persona que quiera probar, lo cierto es que debes contar con una buena condición fisica de partida que te permita afrontar los restos sin riesgo de lesión.";
        $post->content = "¿Cómo saber si estamos preparados o presentamos buena condición?
        Simplemente colócate un reloj para controlar el tiempo y sal a correr. Por norma, se considera que presentas buena condición, o por lo menos lo mínimo que se despacha, que seas capaz de aguantar unos 30 minutos a una intensidad moderada, pudiendo tomar como referencia el hecho de ir corriendo y ser capaz de hablar con un compañero a la par.
        Digamos que ese nivel es el básico. Luego podemos ir subiendo peldaños. Si hacemos caso a un pulsómetro, en vez de tomar la “conversación” como elemento medidor, pues fijaremos nuestras pulsaciones para llevar un ritmo moderado a medio. En este caso, sin profundizar demasiado, una porcentaje entre el 65-75% de nuestra máxima capacidad sería idóneo para mantener durante esos 45-60 minutos.
        ¿Qué puedo hacer si no llego a este nivel básico o pretendo seguir subiendo?
        Pues que se deberá acudir a la capacidad de autosuperación y sacrificio de cada uno, puesto que, aunque no me gusta la palabra, vais a “sufrir” un poco. Pero no os alarméis, que eso sólo durará el periodo de adaptación.

        Entonces si tu posición es el nivel por debajo del básico comenzaremos a practicar nuestra carrera continua de la siguiente manera: alternando periodos de caminar y correr al trote.
        “Walk  & Jog”
        Comenzamos andando a paso rápido, durante 5 minutos, y luego intercalaremos junto al trote. Según la condición de cada persona, podríamos mantener el trote todo lo que se pudiera, estableciendo por supuesto un tiempo mínimo el cual nunca deberemos de rebajar. Dicho tiempo oscilará más o menos, pero se puede colocar el umbral sobre {30”- 1’}, pero siempre quedando a disposición de la condición física.
        Entonces con ello, cuando te encuentres en la fase de trote, mantenlo hasta que ya no puedas más, y seguidamente, no te pares! Continúa moviéndote, esto es, sigue a paso rápido. Reitero el hecho de que a pesar de que bajes el ritmo de trote, nunca te detengas en seco, siempre estarás moviéndote. Ok. Pues que tal repetir esta secuencia, caminar-trote, durante 45 minutos?.
        ¿Durante cuánto tiempo mantengo este tipo de pre-acondicionamiento?
        Pues según seas capaz de aguantar el ritmo de trote, en el momento que ya lo mantengas seguido, sin parar a caminar durante 45 minutos, digamos que estarás en fase de nivel básico. Lo siguiente será subir la intensidad, es decir, mantener un ritmo más alto que el trote durante el tiempo de rigor.";
        $post->published_at = Carbon::now();
        $post->category_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Deporte']));
    }
}
