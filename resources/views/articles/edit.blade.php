@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
    <p> this is the edit page </p>
    <h1>Artikel bewerken</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" value="{{ $article->title }}" required>
        <br>
        <label for="content">Inhoud:</label>
        <textarea id="content" name="content">{{ $article->content }}</textarea>
        <br>
        <button type="submit">Bijwerken</button>
    </form>
@endsection