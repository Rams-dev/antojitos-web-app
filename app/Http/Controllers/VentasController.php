<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\ProductVentas;
use App\Models\Products;
use App\Models\venta_product;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $ventas = new Ventas;
        $data["date"] = date("Y-m-d");
        $data['ventas'] = $ventas->getPedidos();

        return view('ventas.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["products"] = Products::all();
        return view('ventas.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pedido = $request->all();
        $data = new Ventas;
        $data->client_name = $pedido['client_name'];
        $data->price_final = $pedido['price_final'];
        $data->delivered = 0;
        $data->save();
        $id_venta = $data->id;

        $pedido = json_decode($request->get('pedido'));
        $venta_product = new ProductVentas;
        foreach($pedido as $ped){
            foreach($ped as $p){
                $ped->venta_id = $id_venta;
            }
        }

        foreach($pedido as $pe){
            // var_dump($pe);
            $venta_product->insertData($pe);
            //$venta_product->venta_id = $pe->venta_id;
            //$venta_product->product_name = $pe->product_name;
            //$venta_product->amount = $pe->amount;
            //$venta_product->price = $pe->price;
            // $venta_product->save();
        }
        return json_encode("ok");

        //  return redirect('sales')->with("message", "pedigo agregado con exito");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $pventas = new ProductVentas;
        $data['products'] = $pventas->getByIdVenta($id);
        return view('ventas.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function edit(ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ventas $ventas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Pventas = new ProductVentas;
        $pv = $Pventas->getProductsVentas($id);
        foreach($pv as $p){
            $Pventas->deleteProductVentas($p->id);
        }
        Ventas::destroy($id);

        return redirect('sales')->with('message','Venta elimina con exito');

    }
}
