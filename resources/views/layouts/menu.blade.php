<div class="card card-body p-0" style="height: 100%">
    <ul class="list-group menu">
        <li class="list-group-item @if (Request::route()->getName() == 'home') active @endif" onclick="window.location.href='{{ route('home') }}'">
            Accueil</li>
        <li class="list-group-item @if (str_starts_with(Request::route()->getName(), 'orders')) active @endif"
            onclick="window.location.href='{{ route('orders.index') }}'">Commandes</li>
        <li class="list-group-item @if (Request::route()->getName() == 'about') active @endif" onclick="window.location.href='{{ route('about') }}'">A
            propos</li>
        <li class="list-group-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Déconnexion') }}
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</div>
