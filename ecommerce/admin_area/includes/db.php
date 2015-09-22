<?php


$con = mysqli_connect("localhost","root","","ecommerce");

if (mysqli_connect_errno())
{
    echo "Falha ao conectar com o MySQL : " . mysqli_connect_error();
}


?>
