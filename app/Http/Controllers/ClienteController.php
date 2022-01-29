<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function GetClienteBasico()
    {
        $datos = [];
        $dataCliente1 = DB::table('ADMCLIENTE')
            ->where('ESTADO', 'A')
            ->select(['CODIGO', 'RAZONSOCIAL','RUC'])
            //->orderBy('CODIGO', 'ASC')
            //->limit(1)
            ->get();
        // $dataCliente2 = DB::table('ADMCLIENTE')
        //     ->where('ESTADO', 'A')
        //     ->select(['CODIGO', 'RAZONSOCIAL'])
        //     ->orderBy('CODIGO', 'DESC')
        //     ->limit(1)
        //     ->get();
        $dataVendedor1 = DB::table('ADMVENDEDOR')
            ->where('ESTADO', 'A')
            ->select(['CODIGO', 'NOMBRE'])
            //->limit(1)
           // ->orderBy('CODIGO', 'ASC')
            ->get();
        // $dataVendedor2 = DB::table('ADMVENDEDOR')
        //     ->where('ESTADO', 'A')
        //     ->select(['CODIGO', 'NOMBRE'])
        //     ->orderBy('CODIGO', 'DESC')
        //     ->limit(1)
        //     ->get();
 //       return response()->json(['cliente' => $dataCliente1, 'C2' => $dataCliente2, 'V1' => $dataVendedor1, 'V2' => $dataVendedor2]);
        return response()->json(['cliente' => $dataCliente1, 'vendedor' =>  $dataVendedor1]);
    }
}
