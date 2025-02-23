<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTTocken
{
    public static function CreateToken($userEmail, $userID){
        $key = env('JWT_KEY');
        $payload = [
            'iss'=>'laravel-token',
            'iat'=>time(),
            'exp'=>time()+60*60*24*30,
            'userEmail'=>$userEmail,
            'userID'=>$userID, 
        ];
        return JWT::encode($payload,$key,'HS256');
    }
    public static function CreateTokenForSettingPassword($userEmail){
        $key = env('JWT_KEY');
        $payload = [
            'iss'=>'laravel-token',
            'iat'=>time(),
            'exp'=>time()+60*60*24*30,
            'userEmail'=>$userEmail,
            'userID'=>'0'

        ];
        return JWT::encode($payload,$key,'HS256');
    }
    public static function DecodeToken($token){
        try{
            if($token == null){
                return 'unauthorized';
            }
            else{
                $key = env('JWT_KEY');
                $decode = JWT::decode($token, new Key($key, 'HS256'));
                return $decode;
            }
                
        
        }
        catch(Exception $e){
            return 'unauthorized';
        }
    }
}
