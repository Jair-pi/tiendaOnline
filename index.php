<?php

require_once 'config/config.php';
require_once 'config/database.php';



$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>

    <!--BOOTSTRAP
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    -->

    <link href="css/all.min.css" rel="stylesheet">
    <!--<script src="https://kit.fontawesome.com/ab74bfb456.js" crossorigin="anonymous"></script>-->

    <link href="css/estilos.css"rel="stylesheet">
</head>
<body>

    <?php include 'menu.php'; ?>

    <main>
        <!--Contenido-->
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                <?php foreach($resultado as $row) { ?>
                    <div class="col">
                        <!--vista de catalogo-->
                        <div class="card shadow-sm">
                                <?php 
                                
                                $id = $row['id'];
                                $imagen = "images/productos/" . $id . "/principal.jpg";

                                if(!file_exists($imagen)){
                                    $imagen = "images/noimagen.PNG";
                                }
                                ?>

                            <img src="<?php echo $imagen;?>" height="300px">
                            <div class="card-body">
                                        <h5 class="card-text"><?php echo $row['nombre'];?></h5>
                                        <p class="card-text">S/ <?php echo number_format($row['precio'], 2, '.', ',');?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="details.php?id=<?php echo $row['id'];  ?>&token=<?php echo 
                                            hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" 
                                            class="btn btn-primary">Detalles</a>
                                        </div>
                                        <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar al carrito</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script>
        function addProducto(id, token){
            let url = 'clases/carrito.php'
            let formData = new FormData()
            formData.append('id', id)
            formData.append('token', token)

            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors'
                }).then(response => response.json())
                .then(data=>{
                    if(data.ok){
                        let elemento = document.getElementById("num_cart") 
                        elemento.innerHTML = data.numero
                    }
                })
        }

    </script>

</body>
</html>