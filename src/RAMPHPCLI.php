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

namespace Ramphp\Kernel;
error_reporting(0);
use Exception;
use Ramphp\Kernel\lib\Composer;
use Ramphp\Kernel\lib\Generator;

class RAMPHPCLI
{

    public function __construct($path, $ops, $type,?string $name=null)
    {
        error_reporting(0);
        $stime = time();
        //print($stime);
        $com = new Composer($path);
        try{
            $ram = new Generator($com,$ops,$type,$name);
            if($ram->status == -1){
                print("\nFailed Request! Try After Sometime or Report to ramphp@vikshro.in");
            }
            if($ram->status == 0){
                print("\nSomething Went Wrong! Try After Sometime or Report to ramphp@vikshro.in :(");
            }

            if($ram->status == 1){
                print("\nWoW Request Finished in ".(time() - $stime)."ms :)");
                //print $stime;
            }

            if($ram->status == 2){
                print("\nRequest Command not able to create Duplicate requests! :(");
            }
        }catch(Exception $e){
            print($e);
        }
        error_reporting(1);
    }
}
error_reporting(1);