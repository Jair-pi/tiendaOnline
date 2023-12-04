<?php

require_once '../config/database.php';
require_once '../config/config.php';


if(!isset($_SESSION['user_type'])){
    header('Location: ../index.php');
    exit;
}

if($_SESSION['user_type'] != 'admin'){
    header('Location: ../../index.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$descuento = $_POST['descuento'];
$stock = $_POST['stock'];
$categoria = $_POST['categoria'];

$sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, descuento=?, stock=?, id_categoria=? WHERE id = ?";
$stm = $con->prepare($sql);
if($stm->execute([$nombre, $descripcion, $precio, $descuento, $stock, $categoria, $id])){


    // Subir imagen principal
    if($_FILES['imagen_principal']['error'] == UPLOAD_ERR_OK){
        $dir = '../../images/productos/' . $id . '/';
        $permitidos = ['jpeg', 'jpg'];

        $arregloImagen = explode('.', $_FILES['imagen_principal']['name']);
        $extension = strtolower(end($arregloImagen));

        if(in_array($extension, $permitidos)){
            if(!file_exists($dir)){
                mkdir($dir, 0777, true);
            }

            $ruta_img = $dir . 'principal.' . $extension; 
            if(move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $ruta_img)){
                echo "El archivo se cargo correctamente.";
            }else{
                echo "Error al cargar el archivo.";
            }
        }else{
            echo "Archivo no permitido.";
        }
    }else{
        echo "No enviaste el archivo.";
    }

    // Subir imagenes secundarias

    if(isset($_FILES['otras_imagenes'])){
        $dir = '../../images/productos/' . $id . '/';
        $permitidos = ['jpeg', 'jpg'];

        if(!file_exists($dir)){
            mkdir($dir, 0777, true);
        }

        foreach($_FILES['otras_imagenes']['tmp_name'] as $key => $tmp_name){
            $fileName = $_FILES['otras_imagenes']['name'][$key];

            $arregloImagen = explode('.', $fileName);
            $extension = strtolower(end($arregloImagen));

            $nuevoNombre = $dir . uniqid(). '.' . $extension;

            if(in_array($extension, $permitidos)){
                if(move_uploaded_file($tmp_name, $nuevoNombre)){
                    echo "El archivo se cargo correctamente.<br>";
                }else{
                    echo "Error al cargar el archivo.";
                }
            }else{
                echo "Archivo no permitido.";
            }
            
        }
    }

    $idVariante = $_POST['id_variante'] ?? [];
    $modelo = $_POST['modelo'] ?? [];
    $color = $_POST['color'] ?? [];
    $precioVariante = $_POST['precio_variante'] ?? [];
    $stockVariante = $_POST['stock_variante'] ?? [];

    $sizeModelo = count($modelo);

    if($sizeModelo == count($color) && $sizeModelo == count($precioVariante) && $sizeModelo == count($stockVariante)){
        $sql = "INSERT INTO productos_variantes (id_producto, id_modelo, id_color, precio, stock) VALUES (?, ?, ?, ?, ?)";
        $stm = $con->prepare($sql);

        $sqlUpdate = "UPDATE productos_variantes SET id_modelo=?, id_color=?, precio=?, stock=? WHERE id=?";
        $stmUpdate = $con->prepare($sqlUpdate);

        for($i = 0; $i < $sizeModelo; $i++){
            $idModelo = (int)$modelo[$i];
            $idColor = (int)$color[$i];
            $precio = $precioVariante[$i];
            $stock = $stockVariante[$i];

            if(isset($idVariante[$i])){
                $stmUpdate->execute([$idModelo, $idColor, $precio, $stock, $idVariante[$i]]);
            }else{
                $stm->execute([$id, $idModelo, $idColor, $precio, $stock]);
            }
        }
    }
}

header('Location: index.php');


?>
