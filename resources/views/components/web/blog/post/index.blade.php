{{$header}}
@foreach ($posts as $p)
    <div>
        <h3>{{ $p->title}}</h3>
        <a href="{{ route('web.blog.show',$p)}}">IR</a>
        <p>{{ $p->description }}</p>
    </div>
@endforeach

{{$extra}}

{{$posts->links()}}

{{$footer}}
