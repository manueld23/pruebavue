<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new Slim\App([
    "settings"  => [
        "determineRouteBeforeAppMiddleware" => true,
    ]
]);

$app->add(function($request, $response, $next) {
    $route = $request->getAttribute("route");

    $methods = [];

    if (!empty($route)) {
        $pattern = $route->getPattern();

        foreach ($this->router->getRoutes() as $route){
            if ($pattern === $route->getPattern()) {
                $methods = array_merge_recursive($methods, $route->getMethods());
            }
        }
        //Methods holds all of the HTTP Verbs that a particular route handles.
    } else {
        $methods[] = $request->getMethod();
    }

    $response = $next($request, $response);


    return $response->withHeader("Access-Control-Allow-Methods", implode(",", $methods));
});
$app->group('/api', function () {
    // Due to the behaviour of browsers when sending PUT or DELETE request, you must add the OPTIONS method. Read about preflight.
    $this->map(['PUT', 'OPTIONS'], '/{user_id:[0-9]+}', function ($request, $response, $arguments) {
        // Your code here...
    });
  $app->map(['GET','OPTIONS'],'/usuarios', function(Request $request, Response $response){
    $id_cliente = $request->getAttribute('id');
    $usuario = $request->getParsedBody()['usuario'];
    $contrasenia = $request->getParsedBody()['contrasenia'];
    $sql = "SELECT usuario,contrasenia FROM usuarios 
            WHERE usuario = $usuario AND contrasenia = $contrasenia";
    try{
        $db = new db();
        $db = $db->connectionDB();
        $resultado = $db->query($sql);
        
        if($resultado->rowCount() > 0){
            $cliente = $resultado->fetchAll(PDO::FETCH_OBJ);
            return $response;
        
            echo json_encode($cliente);
        }else{
            echo json_encode('NO existe ese cliente');
        }
        
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});
});



//GET Recuperar clientes por id


