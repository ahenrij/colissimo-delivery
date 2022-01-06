@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header p-3 d-flex">
            <div style="font-size: 1.5em">{{ __('Commandes') }}</div>
            <a class="btn btn-primary ml-auto" href="{{ route('orders.create') }}">Nouvelle commande</a>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-responsive">
                <tr>
                    <th>#</th>
                    <th>N° commande</th>
                    <th>Client</th>
                    <th>Site web</th>
                    <th>#</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>{!! isset($i) ? ++$i : ($i = 1) !!}</td>
                        <td>{{ $order->no }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->website }}</td>
                        <div class="dropdown">
                        <td><div class="dropdown show">
                            <a style="color: black" class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="id_actions_{{ $order->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Actions
                            </a>
                            <div class="dropdown-menu" aria-labelledby="id_actions_{{ $order->id }}">
                                <a href="{{ route('orders.show', [$order->id]) }}" class="dropdown-item">Voir</a>
                                <a href="{{ route('orders.edit', [$order->id]) }}" class="dropdown-item">Modifier</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['orders.destroy', $order->id]]) !!}
                                <li><a href="#!" onclick="$('#del_order{{ $order->id }}').click();"
                                        class="dropdown-item">Supprimer</a></li>
                                {!! Form::submit('Supprimer', ['id' => 'del_order' . $order->id, 'hidden' => true, 'class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Vraiment supprimer cette commande ?\')']) !!}
                                {!! Form::close() !!}
                            </div>
                          </div>
                        </td> 
                    </tr>
                @endforeach
            </table>

            {{ $orders->links() }}
        </div>
    </div>
@endsection
