<?php
    use Illuminate\Support\Facades\Auth;

    $current_user = Auth::user();
?>

@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Geplaatst op</th>
                <th>Categorieën</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
                <td>{{ $article->created_at }}</td>
                <?php $categories = $article->categories()->orderBy('name')->get(); ?>
                <td>@foreach($categories as $category)
                        {{$category->name}},
                    @endforeach
                </td>
                @if($current_user && $article->user_id == $current_user->id)
                <td>
                    <a href="{{ route('articles.edit', $article->id) }}">Bewerken</a>
                </td>
                <td>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit artikel wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Verwijderen</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection