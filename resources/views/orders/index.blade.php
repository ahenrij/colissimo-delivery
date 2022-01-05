@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header p-3 d-flex">
            <div style="font-size: 1.5em">{{ __('Commandes') }}</div>
            <a class="btn btn-primary ml-auto" href="#">Nouvelle commande</a>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table">
                <tr>
                    <th>#</th>
                    <th>N° commande</th>
                    <th>Client</th>
                    <th>Site web</th>
                    <th>Actions</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>1</td>
                        <td>{{ $order->no }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->website }}</td>
                        <td>
                            #
                        </td>
                    </tr>
                @endforeach
            </table>

            {{ $orders->links() }}
        </div>
    </div>
@endsection
