<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="select * from imagenes where id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from imagenes";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $titulo=$_POST['titulo'];
    $imagen=$_POST['imagen'];
    $noticia=$_POST['noticia'];
    $link=$_POST['link'];
    $orden=$_POST['orden'];
    $estado=$_POST['estado'];
    $query="insert into imagenes(titulo,imagen,noticia,link,orden,estado) 
            values ('$titulo', '$imagen', '$noticia','$link','$orden','$estado')";
    $queryAutoIncrement="select MAX(id) as id from imagenes";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $titulo=$_POST['titulo'];
    $imagen=$_POST['imagen'];
    $noticia=$_POST['noticia'];
    $link=$_POST['link'];
    $orden=$_POST['orden'];
    $estado=$_POST['estado'];
    $query="UPDATE imagenes SET titulo='$titulo', 
                                imagen='$imagen', 
                                noticia='$noticia',
                                link='$link',
                                orden='$orden',
                                estado='$estado' WHERE id='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM imagenes WHERE id='$id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>