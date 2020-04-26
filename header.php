<?php
                            file_put_contents("ipCC.txt","/".$_SERVER['REMOTE_ADDR']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Matrix Project</title>
        <link rel="stylesheet" href="css/default.css" />
        <link rel="stylesheet" href="css/css.css" />
    </head>
    <body>
        <div class="all">
            <div class="header">
                <ul>
                    <li><a class="active" href="index.php?page=Home">Home</a></li>
                    <li><a href="index.php?page=LGS">LGS</a></li>
                    <li><a href="index.php?page=Inverse">Inverse</a></li>
                    <li><a href="index.php?page=Determinante">Determinante</a></li>
                    <li><a href="index.php?page=Potenz">Potenz</a></li>
                    <li><a href="index.php?page=Transponierte">Transponierte</a></li>
                    <li><a href="index.php?page=Multiplikation">Multiplikation</a></li>
                    <li><a href="index.php?page=Addition">Addition</a></li>
                    <li><a href="index.php?page=Substraktion">Substraktion</a></li>
                </ul>
            </div>
            <div style="clear: both;"></div>

            <div class="Content">
                <div class="classTitle">