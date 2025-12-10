<?php
    use Illuminate\Support\Facades\Auth;

    $current_user = Auth::user();
?>

<nav>
    <ul>
        <li><a href="{{ route('articles.index') }}">Artikel overzicht</a></li>
        

        @if(!$current_user)
        <li><a href="{{ route('auth.login') }}">Inloggen</a></li>
        @else
        <li><a href="{{ route('auth.logout') }}">Uitloggen</a></li>
        @endif
        
        @if(auth()->check())
            @php
                $current_user = auth()->user();
            @endphp
            <li><a href="{{ route('articles.user.index', ['user' => $current_user->id]) }}">Artikelen van {{$current_user->username}}</a></li>
            <li><a href="{{ route('articles.create') }}">Schrijf nieuw artikel</a></li>
            <li><a href="{{ route('categories.index') }}">Categorieën beheren</a></li>
        @endif
    </ul>
</nav>