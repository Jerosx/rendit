<?php

session_start(); #Inicio la sesión
session_destroy(); #destruyo la sesión
echo "<script> alert('SESSIÓN CERRADA');window.location.href='../index.html';</script>";exit;



?>