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
 *  @date             20/08/23, 3:02 am
 *
 */

namespace Ramphp\Kernel\Framework\Database\Grammer;

use Exception;
use mysqli;
use Ramphp\Kernel\Framework\Database\Connect;

class MysqlGrammer
{
    /**
     * @var Connect
     */
    private Connect $connect;
    /**
     * @var mysqli|null
     */
    private mysqli|null $db;
    /**
     * @var string
     */
    public string $table;


    /**
     * @throws Exception
     */
    public function __construct(string $table=null)
    {
        if(!is_null($table)){
            $this->table = $table;
        }
        $this->connect = new Connect();
        if($this->connect->db){
            $this->db = $this->connect->db;
        }else{
            throw new Exception("Grammer DB Connection have Issues! Try again Later");
        }
    }

    public function testTable(?string $table=null){
        if(!is_null($table)){
            $this->table = $table;
        }
        $tables = $this->getTables();
        if(array_search($this->table,$tables)){
            return true;
        }else{
            return false;
        }
    }

    public function getTables(){
        if(!is_null($this->db)){
            $query = "select `TABLE_NAME` as 'name' from information_schema.tables where table_schema = '".$this->connect->config["DB_NAME"]."';";
            $res = $this->db->query($query);
            //return  $res->fetch_all(1);
            $results = array();
            foreach ($res as $re){
                $results[] = $re["name"];
            }
            return $results;
        }
        return false;
    }


    public function getTableScemas(?string $table=null): array
    {
        $result = array();
        if(!is_null($table)){
            $result[] = array(
                "table"=>$table,
                "schema"=>$this->getTableSchema($table)
            );
        }else{
            $tables = $this->getTables();
            foreach($tables as $table){
                $result[] = array(
                    "table"=>$table,
                    "schema"=>$this->getTableSchema($table)
                );
            }
        }
        return $result;
    }

    private function getTableSchema(?string $table=null): bool|array
    {
        $query = "select COLUMN_NAME as `column`, COLUMN_KEY as `key`,DATA_TYPE as `type`,`COLUMN_DEFAULT` as `default`,`COLUMN_TYPE` as `ctype`, `IS_NULLABLE` as `null`, `PRIVILEGES` as `permit` from information_schema.columns where table_schema = '".$this->connect->config["DB_NAME"]."' and table_name = '".$table."';";
        //$query = $this->db->real_escape_string($query);
        $res = $this->db->query($query);
        if($res){
            return $res->fetch_all(1);
        }else{
            return false;
        }
    }

    protected function DataTypes(): array
    {
        return array(
            "bigint"=>"int",
            "int"=>"int",
            "number"=>"int",
            "float"=>"float",
            "double"=>"double",
            "char"=>"string",
            "text"=>"string",
            "longtext"=>"string",
            "mediumtext"=>"string",
            "smalltext"=>"string",
            "varchar"=>"string",
            "json"=>"mixed",
            "array"=>"array",
            "datetime"=>"date",
            "timestamp"=>"date",
        );
    }



}