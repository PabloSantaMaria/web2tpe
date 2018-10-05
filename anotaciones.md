# anotaciones

esto va en otro php que se encargue de conectarse a la db y traer acciones

```php
require_once "acciones.php";

function connect() {
    return new PDO('mysql:host=localhost;'.'dbname=tabrokers;charset=utf8', 'root', '');
}

$db = connect();
```

## traer acciones

```php
$sentencia = $db->prepare( "select * from accion");
$sentencia->execute();

$acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($acciones as $accion) {
    echo $accion['nombre'] . ', ' . $accion['precio'];
}
```

## insertar accion

```php
$sentencia = $db->prepare("INSERT INTO accion(nombre, precio) VALUES(?, ?)");
$sentencia->execute(array('test2', '9,50'));
```

## traer del form lo que se va a insertar

```php
$nombre = $_POST['nombre']; //name del input
$precio = $_POST['precio'];
$sentencia->execute(array($nombre, $precio));
```

## ponerle a todos el isset, si no se rompe**

```php
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}
```

## para volver a la home

### Redirect browser

```php
header("Location: http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));
```