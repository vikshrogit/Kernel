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

class Composer{
    public string $rootdir='';

    public mixed $composer='';

    public string|int $src='';
    public function __construct(string $rootdir)
    {
        //print_r($rootdir);
        $this->rootdir=trim($rootdir);
        $this->composer=json_decode(file_get_contents($this->rootdir.'\composer.json'));
        $temp = (array)$this->composer->autoload->{'psr-4'};
        foreach (array_keys($temp) as $k){
            if($temp[$k] == "src/"){
                $this->src = $k;
            }
        }
    }
}