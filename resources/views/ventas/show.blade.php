@include('.template.head')
@include('.template.navbar')
<!-- {{var_dump($products)}} -->
<div class="list-group">
    <div class="d-flex justify-content-between">
        <strong>Producto</strong>
        <strong>Cantidad</strong>
    </div>
    @foreach($products as $product)
    <a class="list-group-item list-group-item-action" >
        <div class="d-flex flex-row justify-content-between">
            <p>{{$product->product_name}}</p>
            <p class="text-success">{{$product->amount}}</p>
        </div>
    @if($product->observation != "")
        <small class="d-block text-danger">{{$product->observation}}</small>

    @endif
    </a>
    @endforeach

</div>
@include('.template.footer')
