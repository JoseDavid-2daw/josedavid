<?php
    session_start();
    echo $_SESSION['nombre_usuario'] . "<br>";
    echo $_SESSION['email']          . "<br>";
    echo $_SESSION['edad']           . "<br>";
    echo $_SESSION['pais']           . "<br>";
?>