@extends('layouts.app')

@section('content')
    <div class="card p-5">
        <h2>Salut, {{ Auth::user()->name }} !</h2>
        <p class="text-secondary mb-5" style="font-size: 1.2em">Content de vous revoir sur {{ config('app.name', 'Laravel') }}.
        </p>


        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3 p-0" style="max-width: 18rem;">
                    <div class="card-header">Commandes</div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 48px">{{ $orders_count }}</h5>
                        <p class="card-text text-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                              </svg>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-secondary mb-3 p-0" style="max-width: 18rem;">
                    <div class="card-header">Traitées</div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 48px">{{ $treated_count }}</h5>
                        <p class="card-text text-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                              </svg>
                        </p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3 p-0" style="max-width: 18rem;">
                    <div class="card-header">Livrées</div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 48px">{{ $delivered_count }}</h5>
                        <p class="card-text text-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-send-check" viewBox="0 0 16 16">
                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372l2.8-7Zm-2.54 1.183L5.93 9.363 1.591 6.602l11.833-4.733Z"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                              </svg>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-5">
            <div class="col-md-4">
                <div class="card bg-light mb-3 p-0" style="max-width: 18rem;">
                    <div class="card-header">En attente de livraison</div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 48px">{{ $waiting_count }}</h5>
                        <p class="card-text text-end">
                            <img width="60px" height="60px" src="{{ asset('img/status/2.png') }}" alt="waiting delivery">
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-light mb-3 p-0" style="max-width: 18rem;">
                    <div class="card-header">Commandes expédiées</div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 48px">{{ $sent_count }}</h5>
                        <p class="card-text text-end">
                            <img width="60px" height="60px" src="{{ asset('img/status/3.png') }}" alt="sent delivery">
                        </p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card bg-light mb-3 p-0" style="max-width: 18rem;">
                    <div class="card-header">En cours de livraison</div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 48px">{{ $ongoing_count }}</h5>
                        <p class="card-text text-end">
                            <img width="60px" height="60px" src="{{ asset('img/status/4.png') }}" alt="on going delivery">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
