<?php

namespace App\Http\Controllers;

use App\Models\Ventas;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ventas;
     public function __construct()
     {
         $this->ventas = new Ventas;
         
     }

    public function index()
    {
        
        if(file_exists(public_path('storage'))){
        
        }else{
            app('files')->link(
                 storage_path('app/public'), public_path('storage') 
            );
        }

        $ventas = new Ventas;
        $data['ventas'] = $ventas->getNoDeivered();
        $vd = $ventas->getVentasPorDia();
        $total = 0;
        foreach($vd as $v){
            $total += $v->price_final;
        }
        $data['total'] = $total;
        return view('dashboard',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        var_dump($id);
        exit;
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->ventas->updateVenta($id);
        return redirect('dashboard')->with('message','Pedido entregado');
    }

    public function getData(){

        $data['sales'] = $this->ventas->getVentas();
        $data['productsSales'] = $this->ventas->getProductsSales();
        $data['salesLastWeek'] = $this->ventas->getSalesLastWeek();
        return response()->json($data, 200);

    }

   
}
