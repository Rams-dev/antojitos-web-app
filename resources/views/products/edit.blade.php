@include('template.head')
@include('template.navbar')
<h3 class="text-center text-success"> Agregar Producto</h3>

<form action="{{url('/products/' . $product->id)}}" method="post">
@csrf
{{method_field('PATCH')}}
    @include('forms.products',['mode'=>"Editar"])
</form>

@include('template.footer')