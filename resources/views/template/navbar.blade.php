<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{url('/dashboard')}}">chinnita's dinner</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " href="/dashboard">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/products">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sales">Pedidos</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link " href="#">Disabled</a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-3">

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<p>{{ Session::get('message') }} </p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


