@extends('layouts.app')

@section('title', 'Titel van Artikel')

@section('content')
    <h2>{{$article->title}}</h2>
    <p>{{$article->content}}

@endsection