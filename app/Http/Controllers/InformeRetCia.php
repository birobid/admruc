<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class InformeRetCia extends Controller
{
    public function GetRetCia(Request $r){
              
        $f1 = $r['fechadesde'];
        $f2 = $r['fechahasta'];
        $tipoFecha = $r['tipoFecha'];
        $tipoPersona = $r['tipoPersona'];
        $c1 = $r['desde'];
        $c2 = $r['hasta'];      

        $query = DB::table('ADMRETCLIENTE')
        ->join('ADMDEUDAPOS','ADMDEUDAPOS.SECINV','ADMRETCLIENTE.SECINV')
        ->join('ADMCLIENTE','ADMCLIENTE.CODIGO','ADMDEUDAPOS.CLIENTE')
        ->join('ADMVENDEDOR','ADMVENDEDOR.CODIGO','ADMDEUDAPOS.VENDEDOR')
        ->select([
            DB::raw('RTRIM(ADMCLIENTE.CODIGO) as CLIENTE'),
            DB::raw('RTRIM(ADMCLIENTE.RAZONSOCIAL) as RAZONSOCIAL'),
            DB::raw('RTRIM(ADMCLIENTE.RUC) as RUC'),
            DB::raw('RTRIM(ADMCLIENTE.DIRECCION) as DIRECCION'),
            DB::raw('RTRIM(ADMVENDEDOR.CODIGO) as VENDEDOR'),
            DB::raw('RTRIM(ADMVENDEDOR.NOMBRE) as NOMBREVEN'),
            'ADMDEUDAPOS.TIPO',
            'ADMDEUDAPOS.SERIE',
            'ADMDEUDAPOS.NUMERO',
            DB::raw('RTRIM(ADMRETCLIENTE.TIPORET) as TIPORET'),
            DB::raw('RTRIM(ADMRETCLIENTE.FISICO) as FISICO'),
            'ADMRETCLIENTE.PORRET',
            'ADMRETCLIENTE.BASE',
            'ADMRETCLIENTE.MONTO',
            'ADMRETCLIENTE.NUFIRE',
            DB::raw('RTRIM(ADMRETCLIENTE.SERIE) as SERIERET'),
            'ADMRETCLIENTE.FECHA',
            'ADMRETCLIENTE.FECHACADUCA',
            'ADMRETCLIENTE.fechaemiret',
            'ADMRETCLIENTE.NUAUTO'
        ]);

        if( $tipoFecha == "registro"){
            $query->whereBetween( 'ADMRETCLIENTE.FECHA',array($f1,$f2));
        }else{
            $query->whereBetween( 'ADMRETCLIENTE.fechaemiret',array($f1,$f2));
        }

        if( $tipoPersona == "cliente"){
            $query->whereBetween( 'ADMDEUDAPOS.CLIENTE',array($c1,$c2));
        }else{
            $query->whereBetween( 'ADMDEUDAPOS.VENDEDOR',array($c1,$c2));
        }

        return response()->json($query->get());
    }

    public function GetDocsSinRet(Request $r){

        $f1 = $r['fechadesde'];
        $f2 = $r['fechahasta'];
        $tipoPersona = $r['tipoPersona'];
        $c1 = $r['desde'];
        $c2 = $r['hasta'];

        $query = DB::table('ADMDEUDAPOS')
        ->whereBetween( 'ADMDEUDAPOS.FECHAEMI',array($f1,$f2))
        ->join('ADMCLIENTE','ADMCLIENTE.CODIGO','ADMDEUDAPOS.CLIENTE')
        ->join('ADMVENDEDOR','ADMVENDEDOR.CODIGO','ADMDEUDAPOS.VENDEDOR')
        ->select([
            DB::raw('RTRIM(ADMDEUDAPOS.CLIENTE) as CLIENTE'),
            DB::raw('RTRIM(ADMCLIENTE.RAZONSOCIAL) as RAZONSOCIAL'),
            DB::raw('RTRIM(ADMCLIENTE.RUC) as RUC'),
            'ADMCLIENTE.TIPOCONTRIBUYENTE',
            DB::raw('RTRIM(ADMCLIENTE.DIRECCION) as DIRECCION'),
            DB::raw('RTRIM(ADMVENDEDOR.CODIGO) as VENDEDOR'),
            DB::raw('RTRIM(ADMVENDEDOR.NOMBRE) as NOMBREVEN'),
            'ADMDEUDAPOS.TIPO',
            'ADMDEUDAPOS.SERIE',
            'ADMDEUDAPOS.NUMERO',
            'ADMDEUDAPOS.FECHAEMI',
            DB::raw('ROUND(ADMDEUDAPOS.MONTO,2) as MONTO'),
            DB::raw('ROUND(ADMDEUDAPOS.IVA,2) as IVA')
        ]);

        if( $tipoPersona == "cliente"){
            $query->whereBetween( 'ADMDEUDAPOS.CLIENTE',array($c1,$c2));
        }else{
            $query->whereBetween( 'ADMDEUDAPOS.VENDEDOR',array($c1,$c2));
        }

        return response()->json($query->get());

    }
}
