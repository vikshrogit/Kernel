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
 *  @date             19/08/23, 11:51 pm
 *
 */

namespace Ramphp\Kernel\lib;
use Ramphp\Kernel\Framework\Database\Connect;
use Ramphp\Kernel\Framework\Database\Queries\MysqlQueries;


class Connection extends Connect
{
    protected MysqlQueries $queries;
    public function __construct()
    {
        parent::__construct();
        $this->queries = new MysqlQueries();
        //print_r($this->db);
    }

    public function TableLists(): string|bool
    {
        $f = fopen(__DIR__."/test.json",'w+');
        fwrite($f,json_encode($this->queries->getTableScemas("role")));
        return fread($f,1024);
    }
}