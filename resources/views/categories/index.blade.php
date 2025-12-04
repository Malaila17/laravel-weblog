@extends('layouts.app')

@section('title', 'Categorieën')

@section('content')
    <a href="{{ route('categories.create') }}">Nieuwe categorie maken</a>

    <ul>
        @foreach($categories as $category)
        <li>{{$category->name}}</li>
        @endforeach
    </ul>
@endsection