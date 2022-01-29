<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class JwtController extends Controller
{
    public function base64UrlEncode($text)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($text)
        );
    }

    public function CreateToken($user_id){
        
        // get the local secret key
        $secret = getenv('SECRET');

        // Create the token header
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        
        $date_time_ex = Carbon::now()->addDay(1);
        
        // Create the token payload
        $payload = json_encode([
            'user_id' => $user_id,
            'role' => 'admin',
            'exp' => $date_time_ex->timestamp 
        ]);

        // Encode Header
        $base64UrlHeader = $this->base64UrlEncode($header);

        // Encode Payload
        $base64UrlPayload = $this->base64UrlEncode($payload);

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = $this->base64UrlEncode($signature);

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }

    public function ValidateToken($jwt){
        $secret = getenv('SECRET');
        // split the token
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signatureProvided = $tokenParts[2];

        // check the expiration time 
        $expiration = Carbon::createFromTimestamp(json_decode($payload)->exp);
        $tokenExpired = (Carbon::now()->diffInSeconds($expiration, false) < 0);

        // build a signature based on the header and payload using the secret
        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payload);
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        // verify it matches the signature provided in the token
        $signatureValid = ($base64UrlSignature === $signatureProvided);

        if ($tokenExpired) {
            Log::info("Token ha expidado");
            return false;
        } else {
            
            if ($signatureValid) {
                return true;
            } else {
                return false;
                Log::info("firma invalida");
            }            
        }        
    }
}
