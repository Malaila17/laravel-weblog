@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
    <h1>Inloggen</h1>
    {{ $errors }}
    <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Inloggen</button>
    </form>
@endsection