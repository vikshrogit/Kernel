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
 *  @date             20/08/23, 3:25 am
 *
 */

namespace Ramphp\Kernel\Framework\Database\Queries;

use Ramphp\Kernel\Framework\Database\Grammer\MysqlGrammer;

class MysqlQueries extends MysqlGrammer
{
    public function __construct(?string $table = null)
    {
        parent::__construct($table);
    }
}