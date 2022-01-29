<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    public function GetItems(){
        $data =  DB::table('ADMITEM')
        ->where('ESTADO','A')
        ->paginate(100);
        return response()->json($data);
    }

    public function GetItemsLike($nombre){
        
        $data =  DB::table('ADMITEM')
        ->where('ESTADO','A')
        ->where('NOMBRE','like','%'.trim($nombre).'%')
        ->select('ITEM','NOMBRE')
        ->get();
        
        return response()->json($data);
    }
    
}
