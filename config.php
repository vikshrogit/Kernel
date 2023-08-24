<?php
/*
 * *************************************************************************
 *   Copyright (C) VIKSHRO 2017 - 2023, Inc - All Rights Reserved
 *
 *  VIKSHRO and Developer (@vikukumar) Have All Copyright For this File. Removing or
 *  Adding any content will be required permission to use for Commercial puporse.
 *  @application      RAMPHPCLI
 *  @author           VIKSHRO
 *  @site             https://vikshro.in
 *  @date             20/08/23, 12:03 am
 *
 */

use VIKSHRO\VIKCRYPT\VIKCRYPT;

if(file_exists(__DIR__."/../../../config.php")){
    require_once(__DIR__."/../../../config.php");
}else{
    $envPath = __DIR__;
    $path = '';
    for($i=0;$i<3;$i++){
        $path .= "../";
        if(file_exists(__DIR__."/".$path.".env")){
            $envPath = __DIR__."/".$path;
        }
    }
    $dotenv = Dotenv\Dotenv::createImmutable($envPath);
    $dotenv->load();
    $vc = new VIKCRYPT();
    if($_ENV['DB']){
        try {
            $db = $vc->dbDecrypt($_ENV['DB']);
        } catch (Exception $e) {
            print($e);
        }
    }

    return [
        'LOG_PATH' => $envPath . '/logs',
        'DB' => !$_ENV['DB'] ? '' : ($db??''),
        'VERSION' => $_ENV['Version']??1,
    ];
}

