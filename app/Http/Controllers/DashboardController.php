<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function ChartClientes(){

        $date = Carbon::now();
        $contador = DB::table('ADMCLIENTE')
        ->count();

        $ClienteSemana = DB::select(
            DB::raw("SELECT  DATEPART(DAY,FECHAING) AS DIA,count(FECHAING) AS CANTIDAD 
                    FROM ADMCLIENTE 
                    WHERE FECHAING > dateadd(DAY,-15,GETDATE()) 
                    GROUP BY DATEPART(DAY,FECHAING);"
            )
        );

        $ProductosVendidos = DB::select(
            DB::raw("SELECT top 5 COUNT(det.ITEM) as CANTIDAD,det.ITEM, it.NOMBRECORTO as NOMBRE
                    from ADMDETEGRESO det,ADMCABEGRESO cab,ADMITEM it
                    where det.SECUENCIAL = cab.SECUENCIAL
                    and det.ITEM = it.ITEM
                    and cab.FECHA > dateadd(DAY,-80,GETDATE()) 
                    group by det.ITEM, it.NOMBRECORTO"
            )
        );

        $ventasDia = DB::select(
            DB::raw("SELECT NETO,NUMERO,TIPO from ADMCABEGRESO 
                where TIPO in('FAC','NTV')
                AND FECHA = '01-10-2021';"
            )
        );

        $ventasDiaPost = DB::select(
            DB::raw("SELECT top 6 NETO,NUMERO,TIPO from ADMCABEGRESOPOS 
                where TIPO in('FAC','NTV')
                AND FECHA = '01-10-2021';"
            )
        );

        $cobrosDia = DB::select(
            DB::raw("SELECT ISNULL(SUM(MONTO),0) as TOTAL from ADMPAGO 
            where FECHA = '01-10-2021';"
            )
        );

        $cobrosDiapos = DB::select(
            DB::raw("SELECT ISNULL(SUM(MONTO),0) as TOTAL from ADMPAGOPOS 
            where FECHA = '01-10-2021';"
            )
        );

        return response()->json([
            "clientes" => $ClienteSemana,
            "productosTop" => $ProductosVendidos,
            "ventasDia"  => $ventasDiaPost,
            'cobros'=>$cobrosDia,
            'cobrospos'=>$cobrosDiapos
        ]);
    }   
}
