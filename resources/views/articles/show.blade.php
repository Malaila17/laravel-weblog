<?php
    use Illuminate\Support\Facades\Auth;

    $current_user = Auth::user();
?>
@extends('layouts.app')

@section('title', 'Titel van Artikel')

@section('content')
    <h2>{{$article->title}}</h2>
    <p> Categorieën: 
        @foreach($categories as $category)
            {{$category->name}},
        @endforeach
    </p>
    <p>{{$article->content}}
    <br>
 
    @if($current_user)
    <form action="{{ route('comments.store',$article->id) }}" method="POST">
    @csrf
    <label for="content">Nieuwe reactie:</label><br>
    <textarea id="content" name="content"></textarea>
    <br>
    <button type="submit">Opslaan</button>
    </form>
    @else
    <p><a href="{{ route('auth.login') }}">Log in om een reactie te plaatsen</a></p>
    @endif

    <h3>Reacties op dit artikel</h3>
    <ul>
        @foreach($comments as $comment)
        <li>{{$comment->content}}</li>
        @endforeach
    </ul>

@endsection