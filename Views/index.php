
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    
    <!-- titulo -->
    <title><?php $data = "hola";
        echo $data['title']; ?></title>

    <!-- Estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/plugins/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/plugins/perfectscroll/perfect-scrollbar.css'; ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/plugins/pace/pace.css'; ?>" rel="stylesheet">

    
    <!-- Estilos de tema -->
    <link href="<?php echo BASE_URL . 'Assets/css/main.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/css/custom.css'; ?>" rel="stylesheet">

    <link rel="icon" href="<?php echo BASE_URL . 'Assets/images/favicon.ico'; ?>">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="#"><?php echo $data['title']; ?></a>
            </div>
            <p class="auth-description">Bienvenido a Gestion de Produccion de Sermarsu</p>

            <form id="formulario" autocomplete="off">
    <div class="auth-credentials m-b-xxl">
        <label for="Correo" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
        <input type="email" class="form-control m-b-md" id="Correo" name="correo" aria-describedby="Correo" placeholder="Correo Electrónico">

        <label for="Clave" class="form-label">Contraseña <span class="text-danger">*</span></label>
        <input type="password" class="form-control" id="Clave" name="clave" aria-describedby="Clave" placeholder="Contraseña">
    </div>

    <div class="auth-submit">
        <button type="submit" class="btn btn-primary">Acceso</button>
        <a href="#" class="auth-forgot-password float-end">Olvidaste tu Contraseña?</a>
    </div>
</form>
            <div class="divider"></div>
        </div>
    </div>
    
    <script src="<?php echo BASE_URL . 'Assets/plugins/jquery/jquery-3.5.1.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/plugins/bootstrap/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/plugins/perfectscrool/perfect-scrollbar.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/plugins/pace/pace.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/main.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/sweetalert2@11.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/custom.js'; ?>"></script>
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
    <script src="<?php echo BASE_URL . 'Assets/js/pages/login.js'; ?>"></script>
</body>
</html>