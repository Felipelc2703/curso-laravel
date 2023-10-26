@extends('dashboard.layout')

@section('content')

<h1>Actualizar Post: {{$post->title}}</h1>
    @include('dashboard/fragment/errors')

    <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">


        {{-- @csrf --}}
        @method('PATCH')
        @include('dashboard.post.form', ['task' => 'edit'])
        {{-- <label for="">Titulo</label>
        
        <input type="text" name="title" id="" value="{{$post->title}}">
        <label for="">Slug</label>
        <input readonly type="text" name="slug" id="" value="{{$post->slug}}"> 

        <label for="">Categoria</label>
        <select name="category_id" >
            <option value=""></option>
            @foreach ($categories as $titulo => $id)
                <option {{ $post->category_id == $id ? 'selected' : ''}} value="{{ $id}}">{{ $titulo}}</option>
            @endforeach
            
        </select>

        <label for="">Posteado</label>
        <select name="posted" id="">
            <option value=""></option>
            <option {{ $post->posted == 'yes' ? 'selected' : ''}} value="yes">Si</option>
            <option {{ $post->posted == 'not' ? 'selected' : ''}} value="not">No</option>
        </select>

        <label for="">Contenido</label>
        <textarea name="content" id="" cols="30" rows="10" >{{$post->content}}</textarea>

        <label for="">Descripcion</label>
        <textarea name="description" id="" cols="30" rows="10" >{{$post->description}}</textarea>
        
        <button type="submit">Enviar</button> --}}
    </form>
@endsection