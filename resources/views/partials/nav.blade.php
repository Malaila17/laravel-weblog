<nav>
    <ul>
       <li><a href="{{ route('articles.index') }}">Artikel overzicht</a></li>
       <li><a href="{{ route('articles.create') }}">Schrijf nieuw artikel</a></li>
       <li><a href="{{ route('auth.login') }}">Inloggen</a></li>
       <li><a href="{{ route('articles.user.index', 'wieke') }}">Wieke</a></li>
    </ul>
</nav>