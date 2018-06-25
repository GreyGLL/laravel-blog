@extends('admin.layout')
@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">POSTS
                <small>Crear publicación</small>
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
@stop
@section('content')
<div class="row">
    <div class="lang">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-danger btn-xs">
            <i class="fa fa-comment"> ES </i>
        </a>
    </div>
    <div class="lang">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-danger btn-xs">
            <i class="fa fa-comment"> EN </i>
        </a>
    </div>
</div>
<div class="row">
    <div class="card card-danger card-outline">
        <form method="POST" action="{{ route('admin.posts.store') }}">
            {{ csrf_field() }}
            <div class="col-md-8">
                <div class="card-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label>Título de la publicación</label>
                        <input name="title" class="form-control" {{ old( 'title') }} placeholder="Inserta aquí el título de la publicación"> {!! $errors->first('title', '
                        <span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('subtitle') ? 'has-error' : '' }}">
                        <label>Subtítulo de la publicación</label>
                        <textarea name="subtitle" class="form-control" placeholder="Inserta aquí el subtitulo de la publicación">{{ old('subtitle') }}</textarea>
                        {!! $errors->first('subtitle', '
                        <span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                        <label>Contenido de la publicación</label>
                        <textarea rows="10" name="content" class="form-control" id="editor" placeholder="Inserta aquí el contenido completo de la publicación">{{ old('content') }}</textarea>
                        {!! $errors->first('content', '
                        <span class="help-block">:message</span>') !!}
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
                        <input name="published_at" type="text" class="form-control float-right" value="{{ old('published_at') }}"
                            id="reservation">
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                    <label>Categorías</label>
                    <select name="category" class="form-control select2">
                        <option value="">Selecciona una categoria</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old( 'category', $category->id) == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('category', '
                    <span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Etiquetas</label>
                    <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Seleccione las etiquetas" style="width: 100%;">
                        @foreach ($tags as $tag)
                        <option {{ collect(old( 'tags', $tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }} value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{ $errors->has('extract') ? 'has-error' : '' }}">
                    <label>Extracto de la publicación</label>
                    <textarea name="extract" class="form-control" placeholder="Inserta aquí el extracto de la publicación">{{ old('extract') }}</textarea>
                    {!! $errors->first('extract', '
                    <span class="help-block">:message</span>') !!}
                </div>
                    <button type="submit" class="btn btn-danger btn-box">Guardar Publicación</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@stop @push('styles')
<style>
    .ck-editor__editable {
        min-height: 400px;
    }
</style>
<!-- DropZone -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
<!-- flat pickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css"> @endpush @push('scripts')
<!-- DropZone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<!-- CK Editor -->
<script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
<!-- Select2 -->
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<!-- flat pickr-->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $("#reservation").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y"
    });

    //Initialize Select2 Elements
    $('.select2').select2({
        tags: true
    });

    // CK Editor

    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(function (editor) {})
        .catch(function (error) {
            console.error(error)
        })

    //Dropzone

    // var myDropZone = new Dropzone('.dropzone', {
    //     url: '/admin/posts/{{-- $url --}}/images',
    //     acceptedFiles: 'image/*',
    //     paramName: 'image',
    //     maxFilesize: 2,
    //     maxFiles: 1,
    //     headers: {
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     },
    //     dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
    // });

    // myDropzone.on('error', function (file, res) {
    //     var msg = res.image[0];
    //     $('.dz-error-message:last > span').text(msg);
    // });

    // Dropzone.autoDiscover = false;
</script>
@endpush