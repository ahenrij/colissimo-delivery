@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header p-3">
            <div style="font-size: 1.5em">{{ __('Modifier le statut de la commande n° ') . $order->no }}</div>
        </div>
        <div class="card-body">
            <div>
                <small class="text-uppercase">{{ __('Client') }}</small>
                <p class="text-dark text-lead">{{ $order->customer_name }}</p>
            </div>
            <div>
                <small class="text-uppercase">{{ __('Adresse de livraison') }}</small>
                <p class="text-dark text-lead">{{ $order->delivery_address }}</p>
            </div>
            <div>
                <small class="text-uppercase">{{ __('Site web') }}</small>
                <p class="text-dark text-lead">{{ $order->website }}</p>
            </div>
            <div>
                <small class="text-uppercase">{{ __('Etat actuel') }}</small>
                <p class="text-dark text-lead">{{ $status_history[0]->title }}</p>
            </div>
            @if ($next_status)
                <br>
                <hr>
                <div>
                    <small class="text-uppercase text-warning" style="font-weight: 600">{{ __('Etat suivant') }}</small>
                    <p class="text-lead mt-2 alert alert-warning">{{ $next_status->title }}</p>
                    {!! Form::open(['method' => 'PUT', 'route' => ['orders.update', $order->id]]) !!}
                    <div class="form-group col-md-4 ml-0 p-0">
                        <label for="datetime" class="control-label text-uppercase">Date</label>
                        <div class="input-group">
                            {!! Form::text('datetime', date('d/m/Y H:i:s'), ['class' => 'form-control', 'placeholder' => 'DD/MM/YYYY HH:MM:SS']) !!}
                            <span class="input-group-text">
                                <i id="cal" class="bi bi-calendar-event"></i>
                            </span>
                        </div>
                        @if(session('error'))
                            <small class="text-danger">{{ session('error') }}</small>
                        @endif
                    </div>
                    {!! Form::submit('Mettre à l\'état suivant', ['class' => 'btn btn-warning mt-4 px-5 float-end']) !!}
                    {!! Form::close() !!}
                </div>
            @else
                <div>
                    <p class="text-lead alert alert-success">Commande déjà livrée !</p>
                </div>
            @endif
        </div>
    </div>
@endsection
