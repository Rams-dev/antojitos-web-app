@include('template.head')
@include('template.navbar')
    <!-- {{var_dump($products)}} -->
    
    <div class="d-flex justify-content-end">
    <a href="/products/create" class="btn btn-success rounded-circle mr-auto"><i class="fas fa-plus"></i></a>
    </div>
    @if($products->isEmpty())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p class="mt-2">Aqui no hay nada, agrega un producto, bebe</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

        <div class="list-group h-100 mt-3">
    @foreach($products as $product)
            <div class="list-group-item list-group-item-action">
            <div class="d-flex flex-row justify-content-between">
                <p> {{$product->product_name}}</p>
                <p>$ {{$product->price}}</p>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <a href="{{url('/products/'.$product->id.'/edit')}}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ url('/products/'.$product->id)}}" method="post">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Quieres borrar?')" >Eliminar</button>
                </form>
            </div>
            </div>
    @endforeach
        </div>


@include('template.footer')