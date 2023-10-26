@extends('layout.master') 

@section('content')
    @include('fragment.subview')

    @forelse($array as $item)
        <div class="box item">
            <p>*{{$item}}</p>
        </div>
    @empty
        No hay data
    @endforelse

    {{$name}}
    

    

    

@endsection
    

