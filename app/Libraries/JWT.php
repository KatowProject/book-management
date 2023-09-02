<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTUtils
{
    public static function generateToken(array $data): string
    {
        $key = new Key(getenv('JWT_SECRET_KEY'), 'HS256');
        $payload = [
            'iss' => base_url(),
            'aud' => base_url(),
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24,
            'data' => $data
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function decodeToken(string $token): object
    {
        $key = new Key(getenv('JWT_SECRET_KEY'), 'HS256');
        return JWT::decode($token, $key);
    }
}