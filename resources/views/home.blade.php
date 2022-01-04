@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Commandes') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table>
                        <th>
                            <td>#</td>
                            <td>N° commande</td>
                            <td>Client</td>
                            <td>Site web</td>
                            <td>Actions</td>
                        </th>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
