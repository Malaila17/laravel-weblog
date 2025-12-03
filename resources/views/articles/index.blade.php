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
                <td>{{ $article->created_at }}</td>
                <td>
                    <a href="{{ route('articles.edit', $article->id) }}">Bewerken</a>
                </td>
                <td>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Verwijderen</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection