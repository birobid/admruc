<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    public function GetDatos(Request $r) {

       $datos = DB::table('ADMPARAMETROV')
        ->get();

        return response()->json($datos);
    }
}
