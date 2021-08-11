
<div class="form-group">
    <label for="">Nombre del cliente</label>
    <input type="text" class="form-control" name="client_name" id="client_name">
</div>

<div class="form-group">
    <label for="">Producto</label>
    <select name="product_name" id="product_name" class="form-select" aria-label="Default select example">
        @if($products->isEmpty())
        <option value="">Primero agrega tus productos</option>

        @endif
        <option value="">Elige un producto</option>
        @foreach($products as $product)
        <option value="{{$product->product_name .', '. $product->price}}">{{$product->product_name ." - $". $product->price}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Cantidad</label>
    <input type="number" class="form-control" name="amount" id="amount">
</div>

<div class="form-group">
    <label for="">Observación</label>
    <textarea name="observation" id="observation" class="form-control" cols="10" rows="3"></textarea>
</div>

<div class="d-grid gap-2">
    <button  class="btn btn-warning btn-block mt-4" id="añadir"><i class="fas fa-cart-plus"></i></button>
</div>


<table class="table table-striped mt-5">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>precio</th>
        <th>precio total</th>
    </tr>
    </thead>
    <tbody id="tbody">
        <tr id="tr">
        </tr>

    </tbody>
        <tr>
            <th colspan="3">Total</th>
            <th id="total">$</th>
        </tr>
</table>


<div class="d-grid gap-2 ">
    <button type="submit" class="d-none btn btn-success btn-block mt-4 " id="agregar">Agregar pedido</button>
</div>


