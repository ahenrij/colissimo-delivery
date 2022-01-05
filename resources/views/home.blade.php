@extends('layouts.app')

@section('content')
    <div class="card p-5">
        <h3>Salut, {{ Auth::user()->name }} !</h3>

        <p style="font-size: 1.2em">Content de vous revoir sur Post Colissima.</p>
    </div>
@endsection
