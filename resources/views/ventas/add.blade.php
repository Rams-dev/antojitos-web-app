@include('template.head')
@include('template.navbar')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<form  method="post">
    @csrf
    @include('forms.ventas',['mode' => 'Agregar'])
</form>

<script>
const btnAñadir = document.querySelector('#añadir');
const client_name = document.querySelector('#client_name');
const tdbody = document.querySelector('#tbody');
const tr = document.querySelector('#tr');
const amount = document.querySelector('#amount');
const product = document.querySelector('#product_name');
const thtotal = document.querySelector('#total');
const btnagregar = document.querySelector('#agregar');
const observation = document.querySelector('#observation');

let pedido = [];
let total = 0;

btnAñadir.addEventListener('click',function(e){
    e.preventDefault();
    if(product_name.value != "" || amount.value != ""){
        if(pedido.length === 0 ){
            btnagregar.classList.remove('d-none')
        }
        tbody.innerHTML = ""
        let product = product_name.value.split(',')
        var obj= {
                "product_name": product[0],
                'amount': amount.value,
                'price':product[1],
                'price_total': product[1] * amount.value,
                'observation': observation.value, 
        }
    pedido.push(obj);
    calcularTotal()
    filltable()
    product_name.value = "";
    amount.value = "";
    console.log(pedido)
    }else{
        return alert("rellena los campos");
    }
    

})

function calcularTotal(){
    let preciofinal = 0;
   for(ped of pedido){
       preciofinal += ped.price_total;
   }
   total = preciofinal;
   thtotal.innerHTML = total 



}

function filltable(){
    pedido.map(p => {
        tbody.innerHTML += `
        <td>${p.product_name}</td>
        <td>${p.amount}</td>
        <td>$ ${p.price}</td>
        <td>$ ${p.price_total}</td>
        `
    })

    amount.value= pedido

    console.log(pedido)
}



// btnagregar.addEventListener('submit', function(e){
//     e.preventDefault()
//     let formData = new FormData()
//     formData.append('pedido', pedido)
//      // console.log(formData)
//      fetch('/sales',{
//          method: 'post',
//         // mode: 'cors', // no-cors, *cors, same-origin
//         // cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
//         // credentials: 'same-origin', // include, *same-origin, omit
//         body: formData,
//         // headers: {
//         // 'Content-Type': false
//         // // 'Content-Type': 'application/x-www-form-urlencoded',
//         // }
//      })
//     //  .then(res => console.log(res))
// })

$("form").submit(function(e){
    e.preventDefault();
    if($('#client_name').val() == ""){
        alert("Debes ingresar el nombre del cliente")
    }else{
     let ped=[];
     for(p of pedido){
         ped.push(p);
     }
     
    var formData = new FormData($("form")[0])
    formData.set("pedido", JSON.stringify(ped))
    formData.set("price_final", total)
    $.ajax({
        url:"/sales",
        type: 'post',
        data: formData,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        console.log(response)
        if(response=="ok"){
            alert("Pedido exitoso")
            // location.href('/sales')
             location.reload()

        }
    })
    }
})
</script>


@include('template.footer')