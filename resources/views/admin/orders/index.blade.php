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
                                    <a @click="onClick()" href="#{{--{{ route('admin.dishes.show', ['dish'=> $dish->slug ]) }}--}}">
                                        <button class="btn show-btn-deliveroo">Mostra Dettagli</button>
                                        <button class="btn show show-btn-deliveroo"><i class="fas fa-eye"></i></button>
                                    </a>
                                </td>
                            </tr>
                            <tr v-if="visible" >
                                <td>Ordine effettuato in data: </td>
                                <td>{{ $order->final_price }}</td>
                                <td>{{ $order->final_price }}</td>
                                <td>{{ $order->final_price }}</td>
                            </tr>
                            <tr v-if="visible" >
                                <td>prezzo consegna: </td>
                                <td>{{ $order->final_price }}</td>
                                <td>{{ $order->final_price }}</td>
                                <td>{{ $order->final_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <script type="text/javascript">

        var app = new Vue ({
            el: '#root',
            data: {
                visible: false,
            },
            methods: {
                onClick() {
                    this.visible = !this.visible;
                }
            }
        })

    </script>
    @endsection
