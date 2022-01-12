@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card p-5" style="padding-bottom: 250px !important; padding-top: 250px !important">
            <h1 class="text-center">A propos</h1>
            <p style="font-size: 1.5em" class="text-center mb-0">{{ config('app.name', 'Laravel') }}, application de suivi
                de colis.</p>
            <small class="text-center mt-2 mb-5">VERSION 1.0</small>
        </div>
    </div>

@endsection
