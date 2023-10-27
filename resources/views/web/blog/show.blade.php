@extends('web.layout')

@section('content')
    <x-alert class="mb-4" type="Error" :message="$post->title" data-id='1' data-priority="medium"/>
    <x-web.blog.post.show :post="$post" class="bg-blue-100" other-attr="data2"/>  
    
    <h3>Dinamico</h3>
    {{-- <x-dinamic-component component="alert" type="Error" :message="$post->title" data-id='1' data-priority="medium"/> --}}

        <x-dynamic-component component="alert" type="Error" :message="$post->title" data-id='1' data-priority="medium"/>
        <x-dynamic-component component="web.blog.post.show" :post="$post" class="bg-blue-100" other-attr="data2"/>
@endsection