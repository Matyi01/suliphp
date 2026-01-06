<?php
require '../config.php';
require '../db.php';

function create_jwt($payload){
    $header = base64url_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $payload = base64url_encode(json_encode($payload));

    $signature = hash_hmac('sha256', $header . "." . $payload, JWT_SECRET, true);

    return $header . "." . $payload . "." . base64url_encode($signature);
}
