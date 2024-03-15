<?php

session_start(); #Inicio la sesión
session_destroy(); #destruyo la sesión
header("location:../index.html"); #lo devuelvo para el loggin


?>