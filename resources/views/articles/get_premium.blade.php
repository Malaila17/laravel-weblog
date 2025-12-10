<?php
    use Illuminate\Support\Facades\Auth;

    $current_user = Auth::user();
?>

@extends('layouts.app')

@section('title', 'Premium')

@section('content')
    <h1>Krijg toegang tot premium artikelen</h1>
        <form action="{{ route('users.update', ['user' => $current_user->id])}}" method="POST">
        @csrf
        <button type="submit">Get premium</button>
    </form>
@endsection