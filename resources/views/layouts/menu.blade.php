<div>
    <ul class="list-group menu">
        <li class="list-group-item @if(Request::route()->getName() == 'orders.index') active @endif" onclick="window.location.href='{{ route('orders.index') }}'">Commandes</li>
        <li class="list-group-item @if(Request::route()->getName() == 'about') active @endif" onclick="window.location.href='{{ route('about') }}'">A propos</li>
    </ul>
</div>