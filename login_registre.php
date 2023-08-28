<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/style_login_registre.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="body-login">
    <div class="container-form">
        <form action="php/validar_iniciosesion.php" method="post" class="formulario">
            <h2 class="create-account">Iniciar Sesion</h2>
            <div class="iconos">
                <div class="border-icon">
                    <i class='bx bxl-instagram'></i>
                </div>
                <div class="border-icon">
                    <i class='bx bxl-tiktok' ></i>
                </div>
                <div class="border-icon">
                    <i class='bx bxl-facebook-circle' ></i>
                </div>
            </div>
            <input type="number" name="cedula" placeholder="Cédula">
            <input type="password" name="contrasena" placeholder="Contraseña">
            <input type="submit" value="Iniciar Sesion">
            <div class="reserva">Si quieres hospedarte en nuestro hotel puedes ingresar <a href="reserva_fecha.php">aquí</a> y hacer una reserva <br><br>Si ya tienes una reservación y deseas CANCELAR  ingrese <a href="reserva_cancelar.php">aquí</a></div>
        </form>
    </div>
</body>
</html>