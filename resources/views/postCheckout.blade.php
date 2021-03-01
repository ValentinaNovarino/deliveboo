@extends('layouts.app')

@section("content")
<div id="page-success-payment">
    <div class="container-success-payment">
        <div class="card-success-payment">
            <div class="content-success-payment" data-tilt>
                <h1 class="text-center mb-4">OTTIMO</h1>
                <i class="far fa-check-circle text-center mb-4"></i>
                <h3>Il pagamento è andato a buon fine</h3>
                <a href="{{route('guest.restaurants')}}" >
                    <button type="button" name="button" class="btn btn-deliveroo mt-4">Torna ai ristoranti</button>
                </a>
            </div>



        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js" integrity="sha512-SttpKhJqONuBVxbRcuH0wezjuX+BoFoli0yPsnrAADcHsQMW8rkR84ItFHGIkPvhnlRnE2FaifDOUw+EltbuHg==" crossorigin="anonymous"></script>
<script type="text/javascript" >

    VanillaTilt.init(document.querySelectorAll(".card-success-payment"), {
        max:25,
        speed: 400,
        glare: true,
        "max-glare":1,
    })
</script>

@endsection
