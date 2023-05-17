<?php

require 'flight/Flight.php';
require_once './routes/Router.php';


Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=api', 'root', ''));


Flight::route('GET /', function () {
    Flight::jsonp(["API Strudel"]);
});

Flight::route('*', function () {

    Router::handleRequest(Flight::request()->method, Flight::request()->url);


});

Flight::start();







// require 'flight/Flight.php';

// Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=api', 'root', ''));

// Flight::route('GET /', function () {
//     Flight::jsonp(["API alumnos"]);
// });

// Flight::route('GET /alumnos', function () {

//     $sentencia = Flight::db()->prepare("SELECT * FROM `alumnos`");
//     $sentencia->execute();
//     $datos = $sentencia->fetchAll();

//     Flight::json($datos);

// });

// Flight::route('POST /alumnos', function () {
//     $nombres = (Flight::request()->data->nombre);
//     $apellidos = (Flight::request()->data->apellido);

//     $sql = "INSERT INTO alumnos (nombre, apellido) VALUES(?,?)";
//     $sentencia = Flight::db()->prepare($sql);
//     $sentencia->bindParam(1, $nombres);
//     $sentencia->bindParam(2, $apellidos);
//     $sentencia->execute();

//     Flight::jsonp(["Alumno agregado"]);
// });

// Flight::route('DELETE /alumnos', function () {
//     $id = (Flight::request()->data->id);
//     $sql = "DELETE FROM alumnos WHERE id=?";
//     $sentencia = Flight::db()->prepare($sql);
//     $sentencia->bindParam(1, $id);
//     $sentencia->execute();

//     Flight::jsonp(["Alumno borrado"]);
// });

// Flight::route('PUT /alumnos', function () {
//     $id = (Flight::request()->data->id);
//     $nombres = (Flight::request()->data->nombre);
//     $apellidos = (Flight::request()->data->apellido);

//     $sql = "UPDATE alumnos SET nombre= ? ,apellido=? WHERE id=?";
//     $sentencia = Flight::db()->prepare($sql);

//     $sentencia->bindParam(1, $nombres);
//     $sentencia->bindParam(2, $apellidos);
//     $sentencia->bindParam(3, $id);

//     $sentencia->execute();

//     Flight::jsonp(["Alumno Modificado"]);

// });

// Flight::route('GET /alumnos/@id', function ($id) { 
    
//     $sentencia = Flight::db()->prepare("SELECT * FROM `alumnos` WHERE id =?");
//     $sentencia->bindParam(1, $id);
//     $sentencia->execute();
//     $datos = $sentencia->fetchAll();

//     Flight::json($datos);
// });

// Flight::start();