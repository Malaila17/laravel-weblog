@extends('layouts.app')

@section('title', 'Nieuw artikel')

@section('content')
    <h1>Nieuwe blogpost schrijven</h1>
    <form action="{{ route('articles.store')}}" method="POST">
        @csrf
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Inhoud:</label>
        <textarea id="content" name="content"></textarea>
        <br>
        <label for="categories">Categorieën:</label>
        <select id="categories" name="category_ids[]" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <p>Houd Ctrl (windows) / Command (Mac) ingedrukt om meerdere categorieën te selecteren.</p>
        <button type="submit">Opslaan</button>
    </form>
@endsection