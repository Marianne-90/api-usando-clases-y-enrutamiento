<?php 
class AlumnController
{
    public function getAlumnData($id)
    {
        // Buscar alumno por id en la base de datos y devolver su información
        $sentencia = Flight::db()->prepare("SELECT * FROM `alumnos` WHERE id =?");
        $sentencia->bindParam(1, $id);
        $sentencia->execute();
        $datos = $sentencia->fetchAll();
        Flight::json("dentro");
        Flight::json($datos);
    }

    public function getAllAlumns()
    {
        // Obtener todos los alumnos de la base de datos y devolver su información
        $sentencia = Flight::db()->prepare("SELECT * FROM `alumnos`");
        $sentencia->execute();
        $datos = $sentencia->fetchAll();

        Flight::json($datos);
    }
}

class Router
{
    private static $routes = array(
        'GET /alumnos' => array('AlumnController', 'getAllAlumns'),
        'GET /alumnos/@id' => array('AlumnController', 'getAlumnData'),
    );

    public static function handleRequest($method, $uri)
    {
        foreach (self::$routes as $route => $handler) {
            list($routeMethod, $routeUri) = explode(' ', $route, 2);

            if ($routeMethod == $method && preg_match('@^' . preg_replace('#\\\:[a-zA-Z0-9_]+#','([a-zA-Z0-9_\\-]+)',preg_quote($routeUri)) . '$@', $uri, $matches)) {
                array_shift($matches);
                call_user_func_array(array(new $handler[0], $handler[1]), $matches);
                return true;
            }
        }
        return false;
    }
}


?>