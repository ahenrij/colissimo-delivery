@extends('layouts.external')

@section('content')
    <div class="container">
        <h6>{{ config('app.name', 'Laravel') . ' / ' . __('Suivi de colis') }}</h6>

        <br>
        <h4 class="text-secondary mt-4">{{ __('Commande ') . $order->no }}</h4>

        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="card-title text-center">{{ $order->history[0]->title }}</div>
                    <div class="card-body">
                        
                        <p class="text-center mb-0">
                            {{ $order->history[0]->description }}
                        </p>
                    </div>
                </div>
                <div class="card p-4 mt-3">
                    <div class="card-subtitle d-flex flex-row">
                        <div class="material-icons">place</div>
                        <div class="ml-2 subtitle">{{ __('Adresse de livraison') }}</div>
                    </div>
                    <div class="card-body p-2 ml-4 mt-2">
                        {{ $order->customer_name }} <br>
                        {{ $order->delivery_address }} <br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="card-title">{{ __('Suivi des colis') }}</div>
                    <div class="card-body p-0 mt-4">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ count($order->history) * (100/count($status)) }}%" aria-valuenow="{{ count($order->history) * (100/count($status)) }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mt-2">
                            <span>{{ __('A l\'entrepôt') }}</span>
                            <span class="float-right">{{ __('Livré') }}</span>
                        </div>
                        <div class="mt-4">
                            <ul class="list-group list-group-flush">
                                @foreach ($order->history as $_status)
                                <li class="pl-0 pr-0 list-group-item">
                                    <span class="text-secondary text-uppercase mb-0">{{ $_status->pivot->date }}</span>
                                    <br>
                                    <span class="text-dark mt-0 mr-1">{{ $_status->title }}</span>
                                    <br>
                                    <span class="text-secondary">{{ $_status->description }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="card-title text-center">{{ __('Articles dans le colis') . ' (' . count($order->items) . ')' }}</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mt-0">
                            @foreach ($order->items as $item)
                            <li class="list-group-item">
                                <span class="text-secondary mb-0">{{ $item->no }}</span>
                                <br>
                                <span class="text-secondary mt-0 mr-1">{{ $item->quantity }}x</span>
                                <span>{{ $item->title }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection