@extends('dashboard.layout')

@section('content')
    <h1>Crear category</h1>

    @include('dashboard/fragment/errors')

    {{-- @if ($errors->any() )
        @foreach ($errors->all() as $error)
            <div class="error">
                {{ $error}}
            </div>
        @endforeach
    @endif --}}
    <form action="{{ route('category.store') }}" method="post">

        @include('dashboard.category.form')
        
    </form>
@endsection