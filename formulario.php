<?php
    $errores = "";
    $continue = "";

    $paises = ["España","Italia","Francia","Inglaterra","Alemania","Dinamarca","Escocia","Suecia","Suiza"];
    $paisSeleccionado = isset($_GET['pais']) ? $_GET['pais'] : '';

    if (!empty($_POST['step'])) {
        if (empty($_POST['nombre']))
        {
            $errores .= "<span class=\"error\">¡ERROR! No se ha enviado ningún nombre.<br /></span>";
        }
        else if(strlen($_POST['nombre']) < 5 || strlen($_POST['nombre']) > 21)
        {
            $errores .= "<span class=\"error\">¡ERROR! El número de caracteres de nombre es inválido 5-20.<br /></span>";
        }
        else if(!preg_match("/^[a-zA-ZÁ-ÿ]+[a-zA-ZÁ-ÿ0-9._-]+$/",($_POST['nombre'])))
        {
            $errores .= "<span class=\"error\">¡ERROR! Los caracteres de su nombre de usuario son inválidos o no comienza con una letra.<br /></span>";
        }

        if (empty($_POST['email']))
        {
            $errores .= "<span class=\"error\">¡ERROR! No se ha enviado ningún E-mail.<br /></span>";
        }
        else if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/",($_POST['email']))) {
            $errores .= "<span class=\"error\">¡ERROR! El email introducido es inválido.<br /></span>";
        }

        if (empty($_POST['edad']))
        {
            $errores .= "<span class=\"error\">¡ERROR! No se ha enviado ninguna edad.<br /></span>";
        }
        else if(!preg_match("/^[0-9]{1,2}$/",($_POST['edad']))) {
            $errores .= "<span class=\"error\">¡ERROR! La edad introducida es inválida, sólo números de hasta 99 años.<br /></span>";
        }

        if (empty($_POST['pais']))
        {
            $errores .= "<span class=\"error\">¡ERROR! No se ha introducido ningún país.<br /></span>";
        }

        if (empty($errores))
        {
            $abecedario = ["/a/", "/b/", "/c/", "/d/", "/e/", "/f/", "/g/", "/h/", "/i/", "/j/", "/k/", "/l/", "/m/", "/n/", "/ñ/", "/o/", "/p/", "/q/", "/r/", "/s/", "/t/", "/u/", "/v/", "/w/", "/x/", "/y/", "/z/", "/á/", "/é/", "/í/", "/ó/", "/ú/"];
            $abecedario_mayusculas = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "Á", "É", "Í", "Ó", "Ú"];
            $nombre_M = preg_replace($abecedario,$abecedario_mayusculas,$_POST['nombre']);
            session_start();
            $_SESSION['nombre_usuario'] = $nombre_M;
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['edad'] = $_POST['edad'];
            $_SESSION['pais'] = $_POST['pais'];
            header('location: informacion.php');
            exit();
        }
        else {
            echo $errores;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style>
        .error{
            background-color: red;
        }
        label{
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <input type="hidden" name="step" value="1">
        <? echo $errores; ?>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Introduzca su email"><br>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" placeholder="Introduzca su edad"><br>
        <label>País:</label>
        <select name="pais" id="pais">
            <option value="">Todos</option>
            <?php foreach ($paises as $pais): ?>
                <option value="<?php echo $pais; ?>" <?php if ($pais == $paisSeleccionado) echo 'selected'; ?>>
                    <?php echo $pais; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input type="submit" value="envio">
    </form>
    <?php echo $continue; ?>
</body>
</html>

<!--
header(location: informacion.php)
exit();

start_session();
$_SESSION['nombre'] = $_POST['nombre'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['edad'] = $_POST['edad'];
$_SESSION['pais'] = $_POST['nombre'];
-->