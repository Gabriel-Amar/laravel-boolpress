@extends('layouts.admin')


@section('content')
<div class="container">

    <h1>
        {{$post->title}}
    </h1>
    <p>
        {!! $post->content !!}
    </p>
    <small>{{$post->created_at}}</small>
    <h5>
        Pubblicato: {{$post->published ? 'Published' : 'Unpublished'}}
    </h5>
    <p>
        <h2>{{$post->category ? $post->category->name : ''}}</h2>
    </p>
    <ul>
        @foreach ($post->tags as $item)
            <li>{{$item->name}}</li>
        @endforeach
    </ul>
    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" width="100" alt="">
</div>
@endsection