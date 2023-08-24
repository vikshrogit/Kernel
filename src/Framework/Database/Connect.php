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
 *  @date             20/08/23, 12:39 am
 *
 */

namespace Ramphp\Kernel\Framework\Database;

use Ramphp\Kernel\Framework\Config;
class Connect
{
    /**
     * @var mixed | array | null
     */
    public mixed $config=null;

    public \mysqli|null $db = null;
    public function __construct()
   {
       $this->connectDB();
   }

    private function loadConfig(): void
    {

        if(is_null($this->config)){
            $conf = new Config();
            $this->config = (array) $conf->config["DB"];
        }
    }

    public function connectDB(){
        $this->loadConfig();
        if(is_null($this->db)){
            $typ = (str_replace("i","",ucfirst($this->config["DB_TYPE"])));
            $typ = "\Ramphp\Kernel\Framework\Database\\".$typ;
            if(class_exists($typ,true)){
                $this->db = new $typ();
            }
            else{
                print_r("oh");
                $this->db = null;
            }

        }
        return $this->db;
    }
}