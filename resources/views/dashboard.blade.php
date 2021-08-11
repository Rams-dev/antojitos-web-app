

@include('template.head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@include('template.navbar')

@if($total != "" || $total != 0 )
    <a href="" class="list-group-item list-group-item-action d-flex justify-content-between border @if($total < 200) border-warning @else border-success @endif mb-2">
    <small>Total vendido hoy:</small>
    <small>$ {{$total}}</small>
    </a>
@endif


    @if($ventas->isEmpty())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p class="mt-2">¡Aun no se han echo pedidos!</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @foreach($ventas as $venta)
         <a id="btnVenta" href="{{url('/sales/'.$venta->id)}}" class="list-group-item list-group-item-action border border-danger">
            <small class="d-flex align-items-center text-danger mb-2"><i class="far fa-clock p-1"></i> {{ explode(" ",$venta->created_at)[1]}} </small>
            <div class="d-flex flex-row justify-content-between">
                <h4> {{$venta->client_name}}</h4>
                <p>$ {{$venta->price_final}}</p>
            </div>
            <form action="{{ url('/dashboard/'.$venta->id)}}" method="post">
                    @csrf
                    {{method_field('DELETE')}}
                    <div class="d-grid gap-2">
                        <button type="submit" onclick="return confirm('¿Segura que ya lo entregaste?')" class="btn btn-danger btn-block mt-2">Marcar como entregado</button>
                    </div>
                </form>
            </a>
    @endforeach

    <div class="dashboard-grid">
        <div class="card-grid" >
            <h5>Total de ventas</h5>
            <img src="{{asset('storage/img/car.png')}}" alt="" class="card-img">
            <p id="count-sales" class="number"></p>
        </div>

        <div class="card-grid" >
            <h5>Total de productos vendidos</h5>
            <img src="{{asset('storage/img/products.png')}}" alt="" class="card-img">
            <p id="productsSales" class="number"></p>
        </div>

        <div class="card-grid" >
            <!-- <h5>Total de productos vendidos</h5> -->
            <canvas id="chart_client"></canvas>

        </div>

        <div class="card-grid" >
            <!-- <h5>Total de productos vendidos</h5> -->
            <canvas id="chart_sales_week"></canvas>

        </div>
    

    </div>
    <script src="{{url('js/dashboard.js')}}"></script>

    </div>
@include('template.footer')