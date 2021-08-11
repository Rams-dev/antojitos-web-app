
<div class="form-group">
    <label for="product_name">Nombre</label>
    <input type="text" class="form-control" value="{{isset($product->product_name) ? $product->product_name : ''}}"name="product_name">
</div>

<div class="form-group">
    <label for="price">precio</label>
    <input type="number" class="form-control" value="{{isset($product->price) ? $product->price : ''}}" name="price">
</div>

<div class="form-group">
    <label for="category">Categoría</label>
    <input type="text" class="form-control" value="{{isset($product->category) ? $product->category : ''}}"name="category">
</div>

<div class="d-grid gap-2">
    <button class="btn btn-success btn-block mt-4">{{$mode}}</button>
</div>