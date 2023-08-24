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
 *  @date             20/08/23, 4:20 am
 *
 */

namespace Ramphp\Kernel\Framework\Database\Models;

class Model
{
    public $table='role';
    public $key = 'id';

    private $permissions = ['select','insert','update','delete'];

    public int $id=0;
}