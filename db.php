<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 12/19/17
 * Time: 12:59 PM
 */
    //Dataname Name, User, and Pass
    $dsn = 'mysql:host=localhost;dbname=happyte8_Kirby';
    $username = 'happyte8_kirby';
    $password = '$password';

    try
    {
        $db = new PDO($dsn,$username,$password);
    }
    catch (PDOException $e)
    {
        echo 'Error connecting to database'.$e->getMessage();
        exit();
    }
    ?>

