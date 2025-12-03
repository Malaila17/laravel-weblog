<?php
    use Illuminate\Support\Facades\Auth;

    $current_user = Auth::user();
?>

<nav>
    <ul>
        <li><a href="{{ route('articles.index') }}">Artikel overzicht</a></li>
        <li><a href="{{ route('articles.create') }}">Schrijf nieuw artikel</a></li>
        <li><a href="{{ route('auth.login') }}">Inloggen</a></li>

        @if(auth()->check())
            @php
                $current_user = auth()->user();
            @endphp
            <li><a href="{{ route('articles.user.index', ['user' => $current_user->id]) }}">Artikelen van {{$current_user->username}}</a></li>
        @endif

        <li><a href="{{ route('auth.logout') }}">Uitloggen</a></li>
    </ul>
</nav>