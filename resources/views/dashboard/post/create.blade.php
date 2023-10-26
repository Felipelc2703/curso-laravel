@extends('dashboard.layout')

@section('content')
    <h1>Crear Post</h1>

    @include('dashboard/fragment/errors')

    {{-- @if ($errors->any() )
        @foreach ($errors->all() as $error)
            <div class="error">
                {{ $error}}
            </div>
        @endforeach
    @endif --}}
    <form action="{{ route('post.store') }}" method="POST">

        @include('dashboard.post.form')
        {{-- @csrf

        <label for="">Titulo</label>
        <input type="text" name="title" id="" value="{{ old('title',$post->title) }}">

        <label for="">Slug</label>
        <input type="text" name="slug" id="" value="{{ old('slug',$post->slug) }}">

        <label for="">Categoria</label>
        <select name="category_id" >
            <option value=""></option>
            @foreach ($categories as $titulo => $id)
                <option {{ old('category_id',$post->category_id) == $id ? 'selected' : '' }} value="{{ $id}}">{{ $titulo}}</option>
            @endforeach
            
        </select>

        <label for="">Posteado</label>
        <select name="posted" id="">
            <option value=""></option>
            <option {{ old('posted',$post->posted) == 'yes' ? 'selected' : '' }} value="yes">Si</option>
            <option {{ old('posted',$post->posted) == 'not' ? 'selected' : '' }} value="not">No</option>
        </select>

        <label for="">Contenido</label>
        <textarea name="content" id="" cols="30" rows="10" > {{ old('content',$post->content) }} </textarea>

        <label for="">Descripcion</label>
        <textarea name="description" id="" cols="30" rows="10" > {{ old('description',$post->description) }} </textarea>
        
        <button type="submit">Enviar</button> --}}
    </form>
@endsection