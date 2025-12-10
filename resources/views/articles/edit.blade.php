@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
    <p> this is the edit page </p>
    <h1>Artikel bewerken</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype=multipart/form-data>
        @csrf
        @method('PUT')
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" value="{{ $article->title }}" required>
        <br>
        <label for="content">Inhoud:</label>
        <textarea id="content" name="content">{{ $article->content }}</textarea>
        <br><br>
        <label for="myimage">Voeg een afbeelding toe:</label>
        <input type="file" id="myimage" name="myimage"><br><br>
        <label for="categories">Categorieën:</label>
        <select id="categories" name="category_ids[]" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}" {{ $article->categories->contains('id', $category->id) ? 'selected' : '' }}>{{$category->name}}</option>
            @endforeach
        </select>
        <p>Houd Ctrl (windows) / Command (Mac) ingedrukt om meerdere categorieën te selecteren.</p>
        <button type="submit">Bijwerken</button>
    </form>
@endsection