@include('template.head')
@include('template.navbar')

    <div class="d-flex justify-content-end">
    <a href="/sales/create" class="btn btn-success rounded-circle mr-auto"><i class="fas fa-plus"></i></a>
    </div>

    @if($ventas->isEmpty())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p class="mt-2">Aqui no hay nada, agrega un pedido, bebe</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="list-group  mt-3">
    @foreach($ventas as $venta)
         <a href="{{url('/sales/'.$venta->id)}}" class="list-group-item list-group-item-action @if(explode(' ',$venta->created_at)[0] == $date) border-success @else border-defaut @endif" >
         <div class="d-flex justify-content-end">
         <form action="{{ url('/sales/'.$venta->id)}}" method="post">
                    @csrf
                    {{method_field('DELETE')}}
            <button type="submit" onclick="return confirm('¿Quieres borrar?')" class="btn-close " ></button>
            </form>
         </div>
         <div class="d-flex justify-content-between">
            <small class="d-flex align-items-center text-success mb-2"><i class="far fa-clock p-1"></i> {{ explode(" ",$venta->created_at)[1]}}</small>
            @if($venta->delivered == 1)
            <small > 
                Entregado
             </small>
             @else
             <small class="text-danger">
                Sin entregar
             </small>
             @endif
         </div>
            <div class="d-flex flex-row justify-content-between">
                <h4> {{$venta->client_name}}</h4>
                <p>$ {{$venta->price_final}}</p>
            </div>

            <div class="d-flex flex-row justify-content-between align-items-center">
                <!-- <a href="{{url('/products/'.$venta->id.'/edit')}}" class="btn btn-warning btn-sm">Editar</a> -->
                
                    <!-- <button type="submit" class="btn btn-danger btn-sm"  >Eliminar</button> -->
                    
            </div>
            </a>
    @endforeach
    </div>

@include('template.footer')