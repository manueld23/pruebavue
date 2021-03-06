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
//GET todos los productos
$app->get('/api/productos', function(Request $request, Response $response){
    $sql = "SELECT * FROM producto";
    try{
        $db = new db();
        $db = $db->connectionDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0){
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            //ech json_encode($clientes);
            $response = $response->withJson($clientes);
        }else{
            echo json_encode('NO existen registros de clientes en la base de datos');
        }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
    return $response;
});


//GET todos los productos
$app->get('/api/productos/{id}', function(Request $request, Response $response){
    $id_cliente = $request->getAttribute('id');
    $sql = "SELECT * FROM producto WHERE id = $id_cliente";
    try{
        $db = new db();
        $db = $db->connectionDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0){
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            //ech json_encode($clientes);
            $response = $response->withJson($clientes);
        }else{
            echo json_encode('NO existen registros de clientes en la base de datos');
        }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
    return $response;
});


/*$app = new \Slim\App;

//GET todos los productos
$app->get('/api/productos', function(Request $request, Response $response){
    $sql = "SELECT * FROM producto";
    try{
        $db = new db();
        $db = $db->connectionDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0){
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($clientes);
        }else{
            echo json_encode('NO existen registros de clientes en la base de datos');
        }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//GET Recuperar clientes por id
$app->get('/api/productos/{id}', function(Request $request, Response $response){
    $id_cliente = $request->getAttribute('id');
    $sql = "SELECT * FROM producto WHERE id = $id_cliente";
    try{
        $db = new db();
        $db = $db->connectionDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0){
            $cliente = $resultado->fetchAll(PDO::FETCH_OBJ);
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

//INSERT ingresar un nuevo cliente
$app->post('/api/clientes', function(Request $request, Response $response){

    $nombre = $request->getParsedBody()['nombre'];
    $apellidos = $request->getParsedBody()['apellidos'];
    $telefono = $request->getParsedBody()['telefono'];
    $email = $request->getParsedBody()['email'];
    $direccion = $request->getParsedBody()['direccion'];
    $ciudad = $request->getParsedBody()['ciudad'];

    $sql = "INSERT INTO clientes (nombre,apellidos,telefono,email,direccion,ciudad) VALUES
            (:nombre,:apellidos,:telefono,:email,:direccion,:ciudad)";
    try{
        $db = new db();
        $db = $db->connectionDB();
        $resultado = $db->prepare($sql);

        $resultado->bindParam(':nombre',$nombre);
        $resultado->bindParam(':apellidos',$apellidos);
        $resultado->bindParam(':telefono',$telefono);
        $resultado->bindParam(':email',$email);
        $resultado->bindParam(':direccion',$direccion);
        $resultado->bindParam(':ciudad',$ciudad);

        $resultado->execute();
        echo json_encode('Nuevo cliente agregado');

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

// PUT Modificar cliente 
$app->put('/api/clientes/{id}', function(Request $request, Response $response){
    $id_cliente = $request->getAttribute('id');
    $nombre = $request->getParsedBody()['nombre'];
    $apellidos = $request->getParsedBody()['apellidos'];
    $telefono = $request->getParsedBody()['telefono'];
    $email = $request->getParsedBody()['email'];
    $direccion = $request->getParsedBody()['direccion'];
    $ciudad = $request->getParsedBody()['ciudad'];

    json_encode($nombre);
   
   $sql = "UPDATE clientes SET
           nombre = :nombre,
           apellidos = :apellidos,
           telefono = :telefono,
           email = :email,
           direccion = :direccion,
           ciudad = :ciudad
         WHERE id = $id_cliente";
      
   try{
     $db = new db();
     $db = $db->connectionDB();
     $resultado = $db->prepare($sql);
 
     $resultado->bindParam(':nombre', $nombre);
     $resultado->bindParam(':apellidos', $apellidos);
     $resultado->bindParam(':telefono', $telefono);
     $resultado->bindParam(':email', $email);
     $resultado->bindParam(':direccion', $direccion);
     $resultado->bindParam(':ciudad', $ciudad);
 
     $resultado->execute();
     echo json_encode("Cliente modificado.");  
 
     $resultado = null;
     $db = null;
   }catch(PDOException $e){
     echo '{"error" : {"text":'.$e->getMessage().'}';
   }
 });

//Eliminar un cliente
$app->delete('/api/clientes/{id}', function(Request $request, Response $response){
    $id_cliente = $request->getAttribute('id');
    $sql = "DELETE FROM clientes WHERE id = $id_cliente";

    try{
        $db = new db();
        $db = $db->connectionDB();
        $resultado = $db->prepare($sql);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode('Cliente eliminado');
        }else{
            echo json_encode('NO existe ese cliente');
        }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});*/