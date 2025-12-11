@extends('layouts.app')

@section('title', 'Nieuw artikel')

@section('content')
    <h1>Nieuwe blogpost schrijven</h1>
    <form action="{{ route('articles.store')}}" method="POST" enctype=multipart/form-data>
        @csrf
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Inhoud:</label>
        <textarea id="content" name="content"></textarea>
        <br><br>
        <label for="myimage">Voeg een afbeelding toe:</label>
        <input type="file" id="myimage" name="myimage"><br><br>
        <label for="categories">Categorieën:</label>
        <select id="categories" name="category_ids[]" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <p>Houd Ctrl (windows) / Command (Mac) ingedrukt om meerdere categorieën te selecteren.</p>
        <label for="is_premium"> Dit is een premium artikel:</label>
        <input type="hidden" name="is_premium" value="0">
        <input type="checkbox" id="is_premium" name="is_premium" value="1">
        <br><br>
        <button type="submit">Opslaan</button>
    </form>
@endsection