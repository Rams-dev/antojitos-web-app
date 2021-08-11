@include('template.head')
@include('template.navbar')
<h3 class="text-center text-success"> Agregar Producto</h3>
<form action="{{url('/products')}}" method="post">
    @csrf
    @include('forms.products',['mode' => 'Agregar'])
</form>
@include('template.footer')