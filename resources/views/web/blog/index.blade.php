@extends('web.layout')

@section('content')
    <x-web.blog.post.index :posts="$posts" >

        <h1>Listado principal de posts</h1>

        @slot('header')
            <h1>Listado principal de posts -- slot con nombre</h1>
        @endslot
        
        @slot('footer')
            <footer>
                Pie de pagina
            </footer>
        @endslot


        @slot('extra', "Texto de prueba ")
        {{-- @slot('extra')
            Extra
        @endslot --}}

    </x-web.blog.post.index>        
@endsection