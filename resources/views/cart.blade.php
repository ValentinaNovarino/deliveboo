@extends('layouts.app')

{{-- @section('title', 'Cart') --}}

@section('content')

    <span id="status"></span>

    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Piatti</th>
            <th style="width:10%">Prezzo</th>
            <th style="width:8%">Quantità</th>
            <th style="width:22%" class="text-center">Subtotale</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

            {{-- {{dd(session('mainRestaurantId'))}} --}}
        <?php $total = 0 ?>
        @if(session('cart'))
            @foreach((array) session('cart') as $id => $details)
                {{-- {{dd($details['restaurant_id'])}} --}}
                <?php $total += $details['price'] * $details['quantity'] ?>

                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $details['cover'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                                {{-- <h4 class="nomargin">{{ $details['id'] }}</h4> --}}
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">€ {{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" min="1" value="{{ $details['quantity'] }}" class="form-control quantity"/>
                    </td>
                    <td data-th="Subtotal" class="text-center">€ <span class="product-subtotal">{{ $details['price'] * $details['quantity'] }}</span></td>
                    <td class="actions" data-th="">
                        {{-- refresh da azzurro a giallo --}}
                        <button class="btn btn-warning btn-sm update-cart p-2" data-id="{{ $id }}"><i class="fas fa-sync-alt"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart p-2" data-id="{{ $id }}"><i class="fas fa-trash-alt"></i></button>
                        <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Totale ordine € <span class="cart-total">{{ number_format($total, 2) }}</span></strong></td>
            {{session((['order_price' => $total]))}}
        </tr>
        @php $discount = $total * 10 / 100; number_format($discount, 2); @endphp
        @if ($total >= 30)
            <tr class="visible-xs">
                <td class="text-center"><strong>Spedizione gratuita</strong></td>
                {{session((['delivery_price' => 0]))}}
            </tr>
            <tr class="visible-xs">
                <td class="text-center"><strong>Sconto € <span class="cart-total">{{ number_format($discount, 2) }}</span></strong></td>
                {{session((['discount' => $discount]))}}
            </tr>
        @elseif (session('cart'))
            <tr class="visible-xs">
                <td class="text-center"><strong>Spese di spedizione € <span class="cart-total">5</span></strong></td>
                {{session((['delivery_price' => 5]))}}
                {{session((['discount' => 0]))}}
            </tr>
        @endif
        <tr>
            <td><a href="{{ route('guest.restaurants') }}" class="btn btn-deliveroo"><i class="fa fa-angle-left"></i> Continua lo Shopping</a></td>

            @if ($total >= 30)
                @php
                    $final_price = $total + 0 - $discount;
                @endphp
                <td class="hidden-xs text-center"><strong>Totale € <span class="cart-total">{{ number_format($final_price, 2) }}</span></strong></td>
                {{session((['final_price' => $final_price]))}}
            @elseif (session('cart'))
                @php
                    $final_price = $total + 5;
                @endphp
                <td class="hidden-xs text-center"><strong>Totale € <span class="cart-total">{{ number_format($final_price, 2) }}</span></strong></td>
                {{session((['final_price' => $final_price]))}}
            @endif
            {{-- <td class="hidden-xs text-center"><strong>Totale € <span class="cart-total">{{ $total }}</span></strong></td> --}}

            <td colspan="2" class="hidden-xs"></td>
            <td>
                <a href="{{ route('checkout.index') }}" class="btn btn-deliveroo">Procedi con l'ordine</a>
            </td>
        </tr>
        </tfoot>
    </table>


    <script type="text/javascript">

     // const Swal = require('sweetalert2')
        $(".update-cart").click(function (e) {
            e.preventDefault();

            let timerInterval
            Swal.fire({
                title: 'Stiamo aggiornando il tuo carrello!',
                html: 'Attendi',
                // html: element: data-backdrop="static", data-keyboard="false",
                customClass: 'popupCartCustom',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                                b.textContent = Swal.getTimerLeft()
                            }
                        }
                    }, 1)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
            })



            var ele = $(this);

            var parent_row = ele.parents("tr");

            var quantity = parent_row.find(".quantity").val();

            var product_subtotal = parent_row.find("span.product-subtotal");

            var cart_total = $(".cart-total");

            var loading = parent_row.find(".btn-loading");

            loading.show();

            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: quantity},
                dataType: "json",
                success: function (response) {

                    location.reload();
                    loading.hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                    $("#header-bar").html(response.data);

                    product_subtotal.text(response.subTotal);

                    cart_total.text(response.total);

                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            let timerInterval
            Swal.fire({
                title: 'Stiamo aggiornando il tuo carrello!',
                html: 'Attendi',
                customClass: 'popupCartCustom',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                                b.textContent = Swal.getTimerLeft()
                            }
                        }
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
            })

            var ele = $(this);

            var parent_row = ele.parents("tr");

            var cart_total = $(".cart-total");

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    dataType: "json",
                    success: function (response) {

                        location.reload();
                        parent_row.remove();

                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                        $("#header-bar").html(response.data);

                        cart_total.text(response.total);
                    }

                });
            }
        });

    </script>

@endsection

{{-- @section('scripts') --}}




{{-- @endsection --}}
