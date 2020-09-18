<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;


$client = new GuzzleHttp\Client();
$res = $client->request('GET', 'http://localhost/pruebavue/rest/public/api/productos');
echo $res->getStatusCode();
// "200"
echo $res->getHeader('content-type')[0];
// 'application/json; charset=utf8'
echo $res->getBody();
// {"type":"User"...'


//$data = json_decode( file_get_contents("http://localhost/pruebavue/rest/public/api/productos"), true);
//print_r($data);
?>