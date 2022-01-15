@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header p-3">
            <div style="font-size: 1.5em">{{ __('Nouvelle commande') }}</div>
        </div>
        <div class="card-body">
            <form id="id_order_form" action="{{ route('orders.store.ajax') }}" redirect="{{ route('orders.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no">{{ __('N° de commande') }}</label>
                            <input type="text" class="form-control" id="no" name="no"
                                placeholder="{{ __('0123456789') }}">
                            @if ($errors->has('no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('no') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="customer_name">{{ __('Client') }}</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                placeholder="{{ __('Nom du client') }}">
                            @if ($errors->has('customer_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer_name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="delivery_address">{{ __('Adresse de livraison') }}</label>
                            <textarea class="form-control" id="delivery_address" name="delivery_address"
                                placeholder="{{ __('1 Rue de la livraison 00000 Ville') }}"></textarea>
                            @if ($errors->has('delivery_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('delivery_address') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="website">{{ __('Site web') }}</label>
                            <input type="text" class="form-control" id="website" name="website"
                                placeholder="{{ __('https://boutique.com') }}">
                            @if ($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('website') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="delivery_expected_at">{{ __('Date de livraison prévue') }}</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="delivery_expected_at" name="delivery_expected_at">
                            @if ($errors->has('delivery_expected_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('delivery_expected_at') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="card-title">Articles</div>

                        <!--Display items list -->
                        <table class="table table-bordered" id="id_items_table" hidden>
                            <thead>
                                <th>Article N°</th>
                                <th>Description</th>
                                <th>Quantité</th>
                            </thead>
                            <tbody id="id_items_table_body"></tbody>
                            <tfoot id="id_items_table_foot"></tfoot>
                        </table>

                        <!--Form to add item to list -->
                        <table class="table table-bordered">
                            <tr>
                                <td style="min-width: 100px">
                                    <label for="id_item_no">Article N°</label>
                                    <input type="text" class="form-control" name="item_no" id="id_item_no"
                                        data-toggle="tooltip" data-placement="bottom" title="Champ obligatoire" 
                                        onkeyup="addItemOnEnter(event)">
                                </td>
                                <td style="min-width: 350px">
                                    <label for="id_item_title">Description</label>
                                    <input type="text" class="form-control" name="item_title" id="id_item_title"
                                        data-toggle="tooltip" data-placement="bottom" title="Champ obligatoire" 
                                        onkeyup="addItemOnEnter(event)">
                                </td>
                                <td>
                                    <label for="id_item_quantity">Quantité</label>
                                    <input class="form-control" type="number" min="1" name="id_item_quantity" value="1"
                                        id="id_item_quantity" data-toggle="tooltip" data-placement="bottom"
                                        title="Champ obligatoire" onkeyup="addItemOnEnter(event)">
                                </td>
                            </tr>
                        </table>
                        <p>
                        <div id="increment" value="0" hidden></div>
                        <button type="button" onclick="addItem()" class="btn btn-outline-primary mr-2">Ajouter cet article</button>
                        <button type="button" onclick="removeLastItem()" class="btn btn-outline-danger">Supprimer le
                            dernier</button>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <button type="button" onclick="saveOrder()" class="col-md-3 float-right btn btn-dark">{{ __('Enregistrer') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
