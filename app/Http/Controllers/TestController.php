<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ADMITEM;

class TestController extends Controller
{
    public function TestEmpresas(){

        $empresas = DB::table('ADMCONEXION')->select('ID','RUC','CADENACONEXION')->get();

        return response()->json($empresas);

    }

    public function TestSelectItems(){

        $empresas = DB::table('ADMCONEXION')->select('ID','RUC','CADENACONEXION')->get();
        $collectItems = new Collection();

        foreach ($empresas as $key => $value) {
            //Log::info($value->CADENACONEXION);
            $items = DB::connection($value->CADENACONEXION)
            ->table('ADMITEM')
            ->select([
                'ITEM',
                'STOCK',
                'NOMBRE'
            ])
            ->take(5)->get();
            
            $collectItems->push([$value->CADENACONEXION => $items]); 
        }
        return response()->json($collectItems);
    }


    public function SaveItems(){

        $empresas = DB::table('ADMCONEXION')->select('ID','RUC','CADENACONEXION')->get();
      
        try {
            DB::beginTransaction();
            foreach ($empresas as $key => $value) {
                
                $newItem = new ADMITEM();
                $newItem->ITEM= "Test6";
                $newItem->NOMBRE= "ItemMultiBase";
                $newItem->NOMBRECORTO= "Test1";
                $newItem->CATEGORIA= "TESTCAT";
                $newItem->FAMILIA= "FAMTEST";
                $newItem->LINEA= "LINTEAT";
                $newItem->MARCA= "MARCATEST";
                $newItem->PRESENTA= 1;
                $newItem->ESTADO= "A";
                $newItem->DISPOVEN= "S";
                $newItem->IVA= "S";
                $newItem->BIEN= "S";
                $newItem->PROVEEDOR= "P0001";
                $newItem->FACTOR= 1;
                $newItem->STOCK= 5000;
                $newItem->STOCKMI= 0;
                $newItem->STOCKMA= 5000;
                $newItem->PESO= 10;
                $newItem->VOLUMEN= 1;
                $newItem->PRECIO0= 1;
                $newItem->PRECIO1= 1;
                $newItem->PRECIO2= 2;
                $newItem->PRECIO3= 3;
                $newItem->PRECIO4= 4;
                $newItem->PRECIO5= 5;
                $newItem->PVP= 6;
                $newItem->ITEMR= 0;
                $newItem->ULTVEN= "29-01-2022";
                $newItem->ULTCOM= "29-01-2022";
                $newItem->COSTOP= 1;
                $newItem->COSTOU= 1;
                $newItem->OBSERVA= "Etest";
                $newItem->GRUPO= "G001";
                $newItem->COMBO= "N";
                $newItem->REGALO= "N";
                $newItem->CODPROV= "asdada";
                $newItem->PORUTI= 0;
                $newItem->PORUTIVENTA= 0;
                $newItem->CODBARRA= "";
                $newItem->CANFRA= "N";
                $newItem->STOCKMAY= 0;
                $newItem->PORUTIPRE0= 0;
                $newItem->PORUTIPRE1= 0;
                $newItem->PORUTIPRE2= 0;
                $newItem->PORUTIPRE3= 0;
                $newItem->PORUTIPRE4= 0;
                $newItem->PORUTIPRE5= 0;
                $newItem->LITROS= 0;
                $newItem->WEB= "N";
                $newItem->OFERTA= "N";
                $newItem->POFERTA= 0;
                $newItem->NOVEDAD= "N";
                $newItem->IMAGEN= "SINIMAGEN.jpg";
                $newItem->CANTCOMPRA= 0;
                $newItem->SOLOPOS= "N";
                $newItem->CUENTAVENTA= "4202010101";
                $newItem->ESPT= "S";
                $newItem->IMAGENADICIONAL= "SINIMAGEN.jpg";
                $newItem->TIENECTAVENTA= "N";
                $newItem->tipoprofal= "F";
                $newItem->PORDESSUGERIDO= 0;
                $newItem->NUMCOTIZACION= 0;
                $newItem->SOLORECETA= "N";
                $newItem->PSICOTROPICO= "N";
                $newItem->TRATAMIENTOCONTINUO= "N";
                $newItem->CONTROLLOTE= "N";
                $newItem->seccion= "";
                $newItem->percha= "";
                $newItem->REGSANITARIO= "";
                $newItem->EWEB= "N";
                $newItem->TIPOPRODUCTO= "";
                $newItem->cantidadxcaja= 0;
                $newItem->CodShip= "";
                $newItem->descripcion= "";
                $newItem->subcategoria= "";
                $newItem->CARRO= "N";
                $newItem->ESTAENCARRO= "N";
                $newItem->CONCENTRACION= "nada";
                $newItem->FORMAF= "INYECCION";
                $newItem->PRESENTACION= "CONTINUA";
                $newItem->pespecial= "N";
                $newItem->MANEJAARROBA= "N";
        
                $newItem->setConnection($value->CADENACONEXION);
                $newItem->save(); 
            } 
            DB::commit();
            return response()->json(['status'=>'ok','message'=>'items guardados']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage());
        }        
    }
}
