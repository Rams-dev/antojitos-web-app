<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductVentas extends Model
{
    use HasFactory;

    
    public function get(){
        return DB::table('product_ventas')->get();
    }

    public function getByIdVenta($id_venta){
        return DB::table('product_ventas')->where('venta_id', '=', $id_venta)->get();
    }

    public function insertData($data){
        DB::table('product_ventas')->insert([
            'venta_id' => $data->venta_id,
            'product_name' => $data->product_name,
            'amount' => $data->amount,
            'price' => $data->price,
            'price_total' => $data->price_total,
            'observation' => $data->observation,
        ]);
        
        
    }

    public function deleteProductVentas($id){
        DB::table('product_ventas')->where('id','=',$id)->delete();
    }

    public function getProductsVentas($id){
        return DB::table('product_ventas')->where('venta_id','=',$id)->get();
    }

}
