@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Geplaatst op</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
                <!-- <td>{{ $article->title }}</td> -->
                <td>{{ $article->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection