@extends('layouts.app')

@section('title', 'Nieuw artikel')

@section('content')
    <h1>Nieuwe categorie maken</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="name">Nieuw categorie naam:</label>
        <input type="text" name="name" required value="{{ old('name') }}">
    
        @if ($errors->has('name'))
            <span class="error">
                {{ $errors->first('name') }}
            </span>
        @endif
        <br>
        <button type="submit">Opslaan</button>
    </form>
@endsection