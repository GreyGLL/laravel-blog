@extends('admin.layout') @section('header')
<style>
    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }
</style>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">POSTS
                <small>Editar publicación</small>
            </h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-dashboard"></i>Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="fa fa-list"></i>Posts</a>
                </li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@stop @section('content')
<div class="row">
    <!-- foreach recorriendo idiomas -->
    <ul class="nav nav-pills ml-3">
        @foreach ($languages as $id => $language)
        <li @if ($loop->first) class="active" @endif>
            <a style="background-color: #dc3545;" href="#lang-{{ $language->id }}" data-toggle="tab">{{ $language->code }}</a>
        </li>
        @endforeach
    </ul>
</div>

<div class="tab-content ">
    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @foreach ($languages as $language)
        @php
        $postTranslated = $post->getPost($language->code);
        @endphp
        <div @if ($loop->first) class=" tab-pane active" @else class="tab-pane" @endif id="lang-{{ $language->id }}">

            <div class="row">
                <div class="card card-danger card-outline">

                    {{ csrf_field() }} {{ method_field('PUT') }}
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label>Título de la publicación</label>
                                <input name="title-{{ $language->code }}" class="form-control" value="{{ old( 'title', $postTranslated->pivot->title) }}" placeholder="Inserta aquí el título de la publicación"> {!! $errors->first('title', '
                                <span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('subtitle') ? 'has-error' : '' }}">
                                <label>Subtítulo de la publicación</label>
                                <textarea name="subtitle-{{ $language->code }}" class="form-control" placeholder="Inserta aquí el subtitulo de la publicación">{{ old('subtitle', $postTranslated->pivot->extract) }}</textarea>
                                {!! $errors->first('subtitle', '
                                <span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                <label>Contenido de la publicación</label>
                                <textarea rows="10" name="content-{{ $language->code }}" class="form-control" id="editor-{{ $language->code }}" placeholder="Inserta aquí el contenido completo de la publicación">{{ old('content', $postTranslated->pivot->content) }}</textarea>
                                {!! $errors->first('content', '
                                <span class="help-block">:message</span>') !!}
                            </div>
                            <div class="row">
                                @foreach ($post->images as $image)
                                <form method="POST" action="{{ route('admin.images.destroy', $image) }}">
                                    {{ method_field('DELETE') }} {{ csrf_field() }}
                                    <div class="col-md-2">
                                        <a href="{{ route('admin.images.destroy', $image) }}" class="btn btn-danger btn-xs">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                        <img class="img-responsive" src="{{ url($image->url) }}">
                                    </div>
                                </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-danger card-outline">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Fecha de publicación:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input name="published_at" type="text" class="form-control float-right reservation" value="{{ old('published_at', $postTranslated->published_at ? $postTranslated->published_at->format('d/m/Y') : null) }}">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                <label>Categorías</label>
                                <select name="category-{{ $language->code }}" class="form-control select2">
                                    <option value="">Selecciona una categoria</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old( 'category', $postTranslated->pivot->category_id) == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('category', '
                                <span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label>Etiquetas</label>
                                <select name="tags[]-{{ $language->code }}" class="form-control select2" multiple="multiple" data-placeholder="Seleccione las etiquetas"
                                    style="width: 100%;">
                                    @foreach ($tags as $tag)
                                    <option {{ collect(old( 'tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }} value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('extract') ? 'has-error' : '' }}">
                                <label>Extracto de la publicación</label>
                                <textarea name="extract-{{ $language->code }}" class="form-control" placeholder="Inserta aquí el extracto de la publicación">{{ old('extract', $postTranslated->pivot->extract) }}</textarea>
                                {!! $errors->first('extract', '
                                <span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <div class="dropzone">

                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-box">Guardar Publicación</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
            @endforeach
    </form>
    </div>
</div>
@stop @push('styles')
<style>
    .ck-editor__editable {
        min-height: 400px;
    }
</style>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- DropZone -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
<!-- flat pickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css"> @endpush @push('scripts')
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- DropZone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<!-- CK Editor -->
<script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
<!-- Select2 -->
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<!-- flat pickr-->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(".reservation").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y"
    });

    //Initialize Select2 Elements
    $('.select2').select2({
        tags: true
    });

    // CK Editor
    @foreach ($languages as $id => $language)
        ClassicEditor
            .create(document.querySelector('#editor-{{ $language->code }}'))
            .then(function (editor) {})
            .catch(function (error) {
                console.error(error)
            })
    @endforeach

    var myDropZone = new Dropzone('.dropzone', {
        url: '/admin/posts/{{ $postTranslated->url }}/images',
        acceptedFiles: 'image/*',
        paramName: 'image',
        maxFilesize: 2,
        maxFiles: 1,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
    });

    myDropzone.on('error', function (file, res) {
        var msg = res.image[0];
        $('.dz-error-message:last > span').text(msg);
    });

    Dropzone.autoDiscover = false;
</script>
@endpush