<!--menu de navegacion-->
<script src="https://kit.fontawesome.com/ab74bfb456.js" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



<header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <div class="container">
            <a href="index.php" class="navbar-brand">
                <strong>Tienda Online</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catalogo</a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Categoria</a>
                        </li>
                    </ul>
                        <a href="checkout.php" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-cart-shopping"></i> 
                            Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
                        </a>

                        <?php if(isset($_SESSION['user_id'])){ ?>

                            <div class="dropdown">
                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="btn_session" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> &nbsp; <?php echo $_SESSION['user_name']; ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btn_session">
                                    <li><a class="dropdown-item" href="compras.php">Mis compras</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Cerrar sessión</a></li>

                                </ul>
                                </div>

                        <?php }else { ?>
                            <a href="login.php" class="btn btn-success btn-sm"><i class="fas fa-user"></i> Ingresar</a>
                        <?php } ?>

                    
                </div>
            </div>
        </div>
    </header>