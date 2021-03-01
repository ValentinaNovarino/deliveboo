@extends('layouts.dashboard')


    @section('admin.content')
        {{-- {{dd($orders)}} --}}

        <div id="root">
            @if (count($orders) == 0)
                <h2 class="back-dish-title">Non ci sono ordini</h2>
            @else
                <h1>Ordini del tuo ristorante</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome cliente</th>
                            <th scope="col">Totale ordine</th>
                            <th scope="col">Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->guest_name }}</td>
                                <td>{{ $order->final_price }} €</td>
                                <td>
                                    <div class="d-inline-block click">
                                        <button class="btn show-btn-deliveroo">Mostra Dettagli</button>
                                        <button class="btn show show-btn-deliveroo"><i class="fas fa-eye"></i></button>
                                    </div>
                                </td>
                                <tr class="cane">
                                    <td>Ordine effettuato in data: </td>
                                    <td>{{ $order->final_price }}</td>
                                    <td>{{ $order->final_price }}</td>
                                    <td>{{ $order->final_price }}</td>
                                </tr>
                                <tr class="cane">
                                    <td>prezzo consegna: </td>
                                    <td>{{ $order->final_price }}</td>
                                    <td>{{ $order->final_price }}</td>
                                    <td>{{ $order->final_price }}</td>
                                </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
        <script type="text/javascript">

        // $(".click").click(function() {
        //     // $(".cane").toggle();
        //     // $(".cane", this).toggle();
        //     $(this).find(".cane").toggle();
        // })
        var app = new Vue ({
            el: '#root',
            data: {
                visible: false,
            },
            methods: {
                onClick(id) {
                    this.visible = !this.visible;
                }
            }
        })

    </script>
    @endsection
