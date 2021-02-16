<!DOCTYPE html>
@extends('layouts.app')

@section('content')

<div class="wrap">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div class="logo">
                        <img class="logo-header"src="{{'../img/logo-bianco.jpg'}}" alt="">
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="menu-header">
                        <button type="button" name="button">Collabora con noi</button>
                    </div>
                </div>
                <div class="col-md-1 col-xs-12">
                    <button type="button" name="button">0.00</button>
                </div>
                <div class="col-md-1 col-xs-12">
                    <button type="button" name="button">Menu</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-xs-12">
                    <div class="titleHeader">
                        <h1>I piatti che ami, a domicilio.</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="div-search">
                        <div class="search-header">
                            <p>Scegli la tipologia di ristorante che preferisci</p>
                                <input class="search-home"  type="search" name="" value="" placeholder="Inserisci..">
                                <button class="capitalize btn btn-primary" type="button" name="button">cerca</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-xs-12">
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="image-header">
                        <img src="{{'../img/campaignrit.png'}}" alt="">
                        <div class="riquadro-blu-header">
                            <div class="riquadro-blu-header-inside">
                                <h1>#aCasaTuaConDeliveroo</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
