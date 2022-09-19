
<?php 

require_once "vendor/autoload.php";
use iio\libmergepdf\Merger;

# Ruta de los documentos
$documentos = ["ejemplo1.pdf", "ejemplo2.pdf"];

# Crear el "combinador"
$combinador = new Merger;

# Agregar archivo en cada iteración
foreach ($documentos as $documento) {
    $combinador->addFile($documento);
}

# Y combinar o unir
$salida = $combinador->merge();

?>