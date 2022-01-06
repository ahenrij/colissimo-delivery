@extends('layouts.app')

@section('content')
    <div class="card p-5">
        <h3>Salut, {{ Auth::user()->name }} !</h3>

        <p class="text-secondary" style="font-size: 1.2em">Content de vous revoir sur {{ config('app.name', 'Laravel') }}.</p>
    </div>
@endsection
