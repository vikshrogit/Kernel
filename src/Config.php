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
 *  @date             20/08/23, 12:41 am
 *
 */

namespace Ramphp\Kernel;

class Config
{
     public mixed $config='';
     public function __construct()
     {
           $this->config = require __DIR__."/../config.php";
     }
}