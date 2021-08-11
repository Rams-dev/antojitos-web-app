<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ventas extends Model
{
    use HasFactory;

    public function getPedidos(){
        $ventas = DB::table('ventas')
                ->orderBy('ventas.created_at', 'desc' )
                ->get();
        return $ventas;
    }

    public function get(){
        $ventas = DB::table('ventas')
                ->where('delivered', '=', '1' )
                ->orderBy('ventas.created_at', 'desc' )
                ->get();
        return $ventas;
    }

    public function updateVenta($id){
        DB::table('ventas')
                    ->where('id', $id)
                    ->update(['delivered' => 1]);
    }

    public function getNoDeivered(){
        $ventas = DB::table('ventas')
                ->where('delivered', '=', '0' )
                ->orderBy('ventas.created_at', 'desc' )
                ->get();
        return $ventas;
    }

    

    public function getVentasById($id){
        $ventas = DB::table('ventas')
                ->where('id', '=', $id)
                ->get();
        return $ventas;
    }

    
    public function getVentasPorDia(){
        $date = date("Y-m-d"); 
        $morrow = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
        $mañana = date('Y-m-d',$morrow);
        return DB::table('ventas')
                ->where('delivered','=', "1")
                ->where('created_at','>=', $date)
                ->where('created_at','<', $mañana)
                    ->get();
    }

    public function getVentas(){

        $sql = DB::table('ventas')
                ->orderBy('ventas.created_at', 'desc' )
                ->get();

                return $sql;

    }

    public function getProductsSales(){

        $sql = DB::table('product_ventas')
                ->get();

                return $sql;
        
    }

    public function getClientFrequent(){
        $sql = DB::table('ventas')
                ->select(DB::raw('count(client_name) as "numero_de_ventas", client_name'))
                ->get();

                return $sql;
        
    }

    public function getSalesLastWeek(){
        $date = date("Y-m-d"); 
        $last = mktime(0, 0, 0, date("m")  , date("d")-10, date("Y"));
        $lastWeek = date('Y-m-d',$last);
        

        $sql = DB::table('ventas')
                ->where('created_at','<=', $date)
                ->where('created_at','>=', $lastWeek)
                ->get();

                return $sql;
    }
}
