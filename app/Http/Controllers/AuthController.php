<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\JwtController;
use App\Models\ADMOPERADOR;

class AuthController extends Controller
{
    public function AuthLogin(Request $r){

        $username = $r["user"];
        $pass = $r["password"];

        if(trim($username) == "" || trim($pass) == ""){
            return response()->json(['status' => 'error','message'=>'invalid login info']);
        }

        $usuario = ADMOPERADOR::where('codigo','=',$username)
        ->where('estado','A')
        ->count();

        if($usuario > 0){

            $userInput = str_split($pass);
            $UpDown = []; 
            $sig = 1;
            foreach ($userInput as $key => $value) {
                if($sig == 1){
                    array_push($UpDown, chr(ord($value) - 1)); 
                    $sig = 0; 
                }else{
                    array_push($UpDown, chr(ord($value) + 1)); 
                    $sig = 1;
                }
            }

            $usuario = ADMOPERADOR::where('codigo','=',$username)->where('estado','A')->first();
           
            if(trim($usuario->clave) == implode($UpDown)){
                Log::info('Login del usuiario '.$usuario->codigo);
                $jwtGen = new JwtController();
                $jwt_user = $jwtGen->CreateToken($usuario->id);
               
                return response()->json([
                    'status'=>'ok',
                    'accessToken'=> $jwt_user,
                    'data'=>$usuario
                ]);
            }else{
                return response()->json(['status' => 'error','message'=>'invalid password']);
            }            
        }else{
            return response()->json(['status' => 'error','message'=>'invalid user']);
        }        
    }

    //Check tokens to validations.
    public function CheckToken($token){

        $nowDate = Carbon::now()->format('Y-m-d');
        $token_valid = ADMOPERADOR::where('token_id','=',$token)
        ->where('expire_at','>=',$nowDate)
        ->count();

        if($token_valid > 0){
            return true;
        }else{
            return false;
        }        
    }

    //Create user to api request.
    public function createUser(){

        $passwor1 = "A*c]7UXK&b&4ve;}";
        $tokenGen = Str::random(60);

        $user = new ADMOPERADOR();
        $user->name = "apimoderna" ;
        $user->password = Hash::make($passwor1); 
        $user->token_id = $tokenGen;
        $user->create_at = Carbon::now()->format('Y-m-d');
        $user->update_ad = Carbon::now()->format('Y-m-d');
        $user->expire_at = Carbon::now()->addDay(1)->format('Y-m-d');
        $user->remember_token = 0;
        
        try {
            $user->save();
            //return response()->json(['Token'=>$tokenGen,'expire'=>$user->expire_at]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json($th->getMessage());
        }
    }
}
