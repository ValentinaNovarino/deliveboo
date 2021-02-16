@extends('layouts.dashboard')

@section('admin.content')
<div id="root">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col 12">
                <h1>lista piatti del ristorante</h1>
                <a href="{{ route('admin.dishes.create') }}">
                    <button type="button" class="btn btn-info">Aggiungi nuovo piatto</button>
                </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($restaurants) > 1)
                            <h3>seleziona il tuo ristorante</h3>
                            {{-- <select v-model="selected" class="" name="">
                                <option value=""></option>
                                <option value=""></option>
                            </select> --}}

                            <select @change="onChange(this.value)" v-model="selectedValue" class="" name="">
                                <option value="">seleziona ristorante</option>
                                @foreach ($restaurants as $restaurant)
                                    <option @click="showDishes()" :value="{{$restaurant->id}}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>

                            <div v-if="visible" class="prova">
                                ciao
                            </div>
                            {{-- @foreach ($dishes as $dish)
                                @foreach ($dish as $item)
                                    @if ($restaurant->id == 1)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>
                                                <a href="{{ route('admin.dishes.show', ['dish'=> $item->slug ]) }}">
                                                    <button class="btn btn-primary">Show</button>
                                                </a>
                                                <a href="{{ route('admin.dishes.edit', ['dish'=>$item->slug ]) }}">
                                                    <button class="btn btn-info">Modify</button>
                                                </a>
                                                <form class="d-inline"
                                                action="{{ route('admin.dishes.destroy', ['dish'=>$item->slug]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach --}}
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
var app = new Vue ({
    el: '#root',
    data: {
        saluto: 'ciao',
        selectedValue: '',
        // selected: '',
        valore: '',
        visible: false
    },
    methods: {
        onChange(value) {
            console.log(this.selectedValue);
            // this.valore = this.selectedValue;
            // console.log(this.valore);

            axios.post('/api/dishes')
            .then((element) => {
                // this.dishes = response.data.dishes;
                console.log(element.data.response);
                for (var i = 0; i < element.data.response.length; i++) {
                    console.log(element.data.response[i].restaurant_id);
                    this.valore = element.data.response[i].restaurant_id;
                }
            })
        },
        showDishes() {
            if (this.selectedValue == this.valore) {
                this.visible = true;
            }
        },
    },
    mounted() {

    }
})
</script>
@endsection
{{-- <a href="{{ route('admin.dishes.show', ['dish'=> $dish->slug ]) }}">
    <button class="btn btn-primary">Show</button>
</a>
<a href="{{ route('admin.dishes.edit', ['dish'=>$dish->slug ]) }}">
    <button class="btn btn-info">Modify</button>
</a>
<form class="d-inline"
action="{{ route('admin.dishes.destroy', ['dish'=>$dish->slug]) }}" method="POST">
@csrf
@method('DELETE')
<button class="btn btn-danger" type="submit">Delete</button>
</form> --}}
