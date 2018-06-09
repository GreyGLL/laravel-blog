@extends('admin.layout') @section('header')

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear publicación</h1>
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
<form method="POST" action="{{ route('admin.posts.store') }}">
    {{ csrf_field() }}
        <div class="col-md-8">
            <div class="card card-danger">
                <div class="card-body">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label>Título de la publicación</label>
                        <input name="title" class="form-control"
                        value = "{{ old('title') }}" placeholder="Inserte título de la publicación">
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                        <label>Contenido de la publicación</label>
                        <textarea rows="10" name="content" class="form-control" placeholder="Inserta el contenido de la publicación">{{ old('content') }}</textarea>
                        {!! $errors->first('content', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<div class="col-md-4">
    <div class="card card-danger">
        <div class="card-body">
            <div class="form-group">
                <label>Fecha de publicación:</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                    <input name="published_at" type="text" class="form-control float-right"
                    value="{{ old('published_at') }}" id="reservation">
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                <label>Categorías</label>
                <select name="category" class="form-control">
                    <option value="">Seleccione categoría</option>
                    @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                        {{ old('category') == $cateogry->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group">
                <label>Etiquetas</label>
                <select name="tags[]" class="form-control select2"                       multiple="multiple"
                        data-placeholder="Seleccione las etiquetas" style="width: 100%;">
                    @foreach ($tags as $tag)
                        <option {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }} value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group {{ $errors->has('extract') ? 'has-error' : '' }}">
                <label>Extracto de la publicación</label>
                <textarea name="extract" class="form-control textarea" placeholder="Inserta un extracto de la publicación">{{ old('extract') }}</textarea>
                {!! $errors->first('extract', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>

    </div>
</div>
@stop

@push('styles')
    <!-- flat pickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <!-- flat pickr-->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $("#reservation").flatpickr({enableTime: false,
                                    dateFormat: "d-m-Y"});

        //Initialize Select2 Elements
        $('.select2').select2()

        // bootstrap WYSIHTML5 - text editor

        $('.textarea').wysihtml5({
            toolbar: { fa: true }
        })
    </script>
@endpush