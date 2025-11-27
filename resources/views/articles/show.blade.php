@extends('layouts.app')

@section('title', 'Titel van Artikel')

@section('content')
    <h2>{{$article->title}}</h2>
    <p>{{$article->content}}
    <br>
 
    <form action="{{ route('comments.store',$article->id) }}" method="POST">
    @csrf
    <label for="content">Nieuwe reactie:</label><br>
    <textarea id="content" name="content"></textarea>
    <br>
    <button type="submit">Opslaan</button>
    </form>

    <h3>Reacties op dit artikel</h3>
    <ul>
        @foreach($comments as $comment)
        <li>{{$comment->content}}</li>
        @endforeach
    </ul>

@endsection