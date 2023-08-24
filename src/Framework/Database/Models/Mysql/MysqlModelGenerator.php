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
 *  @date             20/08/23, 4:22 am
 *
 */

namespace Ramphp\Kernel\Framework\Database\Models\Mysql;

use Ramphp\Kernel\Framework\Database\Grammer\MysqlGrammer;

class MysqlModelGenerator extends MysqlGrammer
{
    public function __construct(?string $table = null)
    {
        parent::__construct($table);
    }

    public function generateModel(?string $table = null){

    }
}