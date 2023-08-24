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

use Exception;
error_reporting(0);


class Generator{
    protected mixed $composer;
    private string $src;

    private mixed $rootdir;

    public int $status = 0;

    /**
     * @throws Exception
     */
    public function __construct(Composer $cfile,string $ops="g", string $type="c",?string $value=null)
    {
        $this->composer=$cfile->composer;
        $this->src=$cfile->src;
        $this->rootdir=$cfile->rootdir;

        if(strtolower($ops) == "g" || strtolower($ops) == "generate"){
            if(strtolower($type) == "c" || strtolower($type) == "component"){
                if(is_null($value)){
                    print("<module>/<component> name Required to Generate Component");
                    exit(0);
                    throw new Exception("<module>/<component> name Required to Generate Component");
                }
                $this->generateComponent($value);
            }

            if(strtolower($type) == "s" || strtolower($type) == "-s" || strtolower($type) == "service"){
                if(is_null($value)){
                    print("<module>/<service> name Required to Generate Service");
                    exit(0);
                    throw new Exception("<module>/<service> name Required to Generate Service");
                }
                $this->generateServices($value);
            }

            if(strtolower($type) == "m" || strtolower($type) == "-m" || strtolower($type) == "model"){
                $con = new Connection();
                print_r($con->TableLists());
            }

        }
    }

    /**
     * @throws Exception
     */
    function generateComponent($name): void
    {
        $name = explode("/",$name);
        $component = array_pop($name);
        $namespace = $this->src."Views";
        $path = $this->rootdir."\src\Views";
        if(!is_dir($path)){
            mkdir($path);
            /*View File Check*/
            if(!file_exists($path."\View.php")){
                $this->createVeiw($path,$namespace);
            }
            if(!class_exists($namespace."\View")){
                $this->createVeiw($path,$namespace);
            }
        }
        if(count($name)){
            foreach ($name as $n){
                $path = $path.'\\'.(ucfirst($n))."Module";
                $namespace = $namespace.'\\'.(ucfirst($n))."Module";
                $this->createModulePHP($path,$namespace);
            }
        }
        /*Component Creation*/
        $path = $path.'\\'.(ucfirst($component))."Component";
        $namespace = $namespace.'\\'.(ucfirst($component))."Component";
        if(is_dir($path)){
            $this->status = 2;
            print("Component Name Already Exists! Try with Another Name");
            exit(0);
            throw new Exception("Component Name Already Exists!");
        }
        else{
            mkdir($path);
            $this->createStyleFile($path,$component);
            $this->createHtmlFile($path,$component);
            $this->createPhpFile($path,$component,$namespace);
            print($component." Component Created!");
            $this->status = 1;
        }
    }


    private function createStyleFile($path,$name): void
    {
        $css = fopen($path."\\".ucfirst($name)."Component.css",'w');
        fwrite($css,"");
        fclose($css);
    }

    private function createJSFile($path,$name): void
    {
        $js = fopen($path."\\".ucfirst($name)."Component.js",'w');
        fwrite($js,"");
        fclose($js);
    }

    private function createHtmlFile($path,$name): void
    {
        $html = fopen($path."\\".ucfirst($name)."Component.html",'w');
        fwrite($html,"<h1>".ucfirst($name)." Component Working!</h1>");
        fclose($html);
    }

    private function createPhpFile($path,$name,$namespace): void
    {
        $php = fopen($path."\\".ucfirst($name)."Component.php",'w');
        fwrite($php,"<?php\nnamespace ".$namespace.";");
        fwrite($php,"\nclass ".ucfirst($name)."Component {");
        fwrite($php,"\n     private \$style= '".ucfirst($name)."Component.css';");
        fwrite($php,"\n     private \$js= '".ucfirst($name)."Component.js';");
        fwrite($php,"\n     private \$loc='';");
        fwrite($php,"\n     private \$host='https://vikshro.in';");
        fwrite($php,"\n     private \$v=1;");
        fwrite($php,"\n");
        fwrite($php,"\n     public function __construct(\$host='',\$page='Home',\$loc=''){");
        fwrite($php,"\n           if (\$host !=''){");
        fwrite($php,"\n               \$this->host=\$host;");
        fwrite($php,"\n           }");
        fwrite($php,"\n           if (\$loc !=''){");
        fwrite($php,"\n               \$this->loc=\$loc;");
        fwrite($php,"\n           }");
        fwrite($php,"\n     }");
        fwrite($php,"\n");
        fwrite($php,"\n     public function __destruct(){");
        fwrite($php,"\n           echo '<app-".strtolower($name)." id=\"app".ucfirst($name)."\"><style scoped>';");
        fwrite($php,"\n           include(\$this->style);");
        fwrite($php,"\n           echo '</style>';");
        fwrite($php,"\n           include('".ucfirst($name)."Component.html');");
        fwrite($php,"\n           echo '<script>';");
        fwrite($php,"\n           include(\$this->js);");
        fwrite($php,"\n           echo '</script>';");
        fwrite($php,"\n           echo '</app-".strtolower($name).">';");
        fwrite($php,"\n     }");
        fwrite($php,"\n}");
        fclose($php);
    }

    private function createVeiw($path,$namespace): void
    {
        if(!file_exists($path."\View.php")){
            mkdir($path);
            $mf = fopen($path."\View.php",'w');
            fwrite($mf,"<?php\nnamespace ".$namespace.";");
            fwrite($mf,"\nclass View {");
            fwrite($mf,"\n      private \$host='https://vikshro.in';");
            fwrite($mf,"\n      private \$page='Home';");
            fwrite($mf,"\n      private \$loc='';");
            fwrite($mf,"\n      private int \$v=1;");
            fwrite($mf,"\n      public function __construct(\$host='',\$page=['Services',''],\$loc=\"../\"){");
            fwrite($mf,"\n                   if (\$host !=''){");
            fwrite($mf,"\n                          \$this->host=\$host;");
            fwrite($mf,"\n                   };");
            fwrite($mf,"\n                   \$this->page=\$page;");
            fwrite($mf,"\n                   \$this->loc=\$loc;");
            fwrite($mf,"\n                   ");
            fwrite($mf,"\n                   ");
            fwrite($mf,"\n      }");
            fwrite($mf,"\n");
            fwrite($mf,"\n      public function load(\$component, array \$query=[], array \$data=[]):void{");
            fwrite($mf,"\n                   \$component = ucfirst(\$component).\"Component\";");
            fwrite($mf,"\n                   \$component= \"\\".$namespace."\\\\\".\$component.\"\\\\\".\$component;");
            fwrite($mf,"\n                   if(class_exists(\$component,true)){");
            fwrite($mf,"\n                            \$component = new \$component(\$host=\$this->host,\$page=\$this->page,\$loc=\$this->loc);");
            fwrite($mf,"\n                           // \$component->view(\"Changed\");");
            fwrite($mf,"\n                   }else{");
            fwrite($mf,"\n                            self::load(\"Error404\");");
            fwrite($mf,"\n                   }");
            fwrite($mf,"\n      }");
            fwrite($mf,"\n");
            fwrite($mf,"\n     public function pageload(mixed \$Components=[],array \$query=[], array \$data=[]): void");
            fwrite($mf,"\n     {");
            fwrite($mf,"\n         \$len = count(\$Components);");
            fwrite($mf,"\n         \$view=\"".$this->src."\\Views\";");
            fwrite($mf,"\n         if(\$len == 1){");
            fwrite($mf,"\n              self::load(\$Components[0],\$query,\$data);");
            fwrite($mf,"\n         }else{");
            fwrite($mf,"\n              \$component = array_pop(\$Components);");
            fwrite($mf,"\n              foreach (\$Components as \$module){");
            fwrite($mf,"\n                     \$view = \$view.\"\\\\\".ucfirst(\$module).\"Module\";");
            fwrite($mf,"\n              }");
            fwrite($mf,"\n              \$view = \$view.\"\mView\";");
            fwrite($mf,"\n              if(class_exists(\$view,true)) {");
            fwrite($mf,"\n                   \$view = new \$view(\$host = \$this->host, \$page = \$this->page, \$loc = \$this->loc);");
            fwrite($mf,"\n                    \$view->load(ucfirst(\$component), \$query, \$data);");
            fwrite($mf,"\n              }else{");
            fwrite($mf,"\n                 self::load(\"Error404\");");
            fwrite($mf,"\n              }");
            fwrite($mf,"\n          }");
            fwrite($mf,"\n     }");
            fwrite($mf,"\n");
            fwrite($mf,"\n     public function moduleLoad(string \$module=\"Admin\", string \$component=\"Install\", array \$query=[], array \$data=[]): void");
            fwrite($mf,"\n     {");
            fwrite($mf,"\n             \$module = \"".$this->src."\Views\\\\\".ucfirst(\$module).\"Module\\mView\";");
            fwrite($mf,"\n             if(class_exists(\$module,true)){");
            fwrite($mf,"\n                 \$module = new \$module(\$host=\$this->host,\$page=\$this->page,\$loc=\$this->loc);");
            fwrite($mf,"\n                 \$module->load(ucfirst(\$component),\$query,\$data);");
            fwrite($mf,"\n            }else{");
            fwrite($mf,"\n                 self::load(\"Error404\");");
            fwrite($mf,"\n            }");
            fwrite($mf,"\n      }");
            fwrite($mf,"\n");
            fwrite($mf,"\n      public function __destruct(){}");
            fwrite($mf,"\n}");
            fclose($mf);
        }
    }

    private function createModulePHP($path,$namespace): void
    {
        if(!file_exists($path."\mView.php")){
            mkdir($path);
            $mf = fopen($path."\mView.php",'w');
            fwrite($mf,"<?php\nnamespace ".$namespace.";");
            fwrite($mf,"\nclass mView extends \\".$this->src."Views\View{");
            fwrite($mf,"\n      private \$host='https://vikshro.in';");
            fwrite($mf,"\n      private \$page='Home';");
            fwrite($mf,"\n      private \$loc='../';");
            fwrite($mf,"\n      public function __construct(\$host='',\$page=['Services',''],\$loc=\"../\"){");
            fwrite($mf,"\n                   if (\$host !=''){");
            fwrite($mf,"\n                          \$this->host=\$host;");
            fwrite($mf,"\n                   };");
            fwrite($mf,"\n                   \$this->page=\$page;");
            fwrite($mf,"\n                   \$this->loc=\$loc;");
            fwrite($mf,"\n                   parent::__construct(\$host=\$this->host,\$page=\$page[0],\$loc=\$this->loc);");
            fwrite($mf,"\n                   parent::__construct(\$host=\$this->host,\$page=\$page[0],\$loc=\$this->loc);");
            fwrite($mf,"\n      }");
            fwrite($mf,"\n");
            fwrite($mf,"\n      public function load(\$component, array \$query=[], array \$data=[]):void{");
            fwrite($mf,"\n                   \$component = \$component.\"Component\";");
            fwrite($mf,"\n                   \$component=\"\\".$namespace."\\\\\".\$component.\"\\\\\".\$component;");
            fwrite($mf,"\n                   if(class_exists(\$component,true)){");
            fwrite($mf,"\n                            \$component = new \$component(\$host=\$this->host,\$page=\$this->page,\$loc=\$this->loc);");
            fwrite($mf,"\n                            \$component->view(\"Changed\");");
            fwrite($mf,"\n                   }else{");
            fwrite($mf,"\n                            parent::load(\"Error404\");");
            fwrite($mf,"\n                   }");
            fwrite($mf,"\n      }");
            fwrite($mf,"\n");
            fwrite($mf,"\n      public function __destruct(){}");
            fwrite($mf,"\n}");
            fclose($mf);
        }
    }

    /**
     * @throws Exception
     */
    function generateServices($name): void
    {
        $name = explode("/",$name);
        $namespace = $this->src."Services";
        $path = "src\Services";
        if(!is_dir($path)){
            mkdir($path);
            /*View File Check*/

        }
        if(count($name)){
            foreach ($name as $n){
                $path = $path.'\\'.(ucfirst($n))."ServiceModule";
                $namespace = $namespace.'\\'.(ucfirst($n))."ServiceModule";
                if(!is_dir($path)){
                    if(!mkdir($path)){
                        $this->status = -1;
                        print("Unable to Create '".$path."' Directory");
                        exit(0);
                        throw new Exception("Unable to Create '".$path."' Directory");
                    }
                }
            }
        }
        /*Service Creation*/
        $service = ucfirst(array_pop($name))."Service";
        if(file_exists($path."\\".$service.".php")){
            $this->status=2;
            print("Service Name Already Exists! Try with Another Name");
            exit(0);
            throw new Exception("Service Name Already Exists!");
        }
        else{
            $sf = fopen($path."\\".$service.".php",'w');
            if(!$sf){
                $this->status=-1;
                print("Unable to Create Service File");
                exit(0);
                throw new Exception("Unable to Create Service File");
            }
            try {
                fwrite($sf, "<?php");
                fwrite($sf, "\n namespace " . $namespace . ";");
                fwrite($sf, "\n ");
                fwrite($sf, "\n use Exception;");
                fwrite($sf, "\n use Ramphp\Router\lib\Request;");
                fwrite($sf, "\n use VIKSHRO\VIKCRYPT\VIKCRYPT;");
                fwrite($sf, "\n ");
                fwrite($sf, "\n ");
                fwrite($sf, "\n class " . $service . "{");
                fwrite($sf, "\n      ");
                fwrite($sf, "\n      private Request \$request;");
                fwrite($sf, "\n      private VIKCRYPT \$vc;");
                fwrite($sf, "\n      ");
                fwrite($sf, "\n      function __construct(Request \$request){");
                fwrite($sf, "\n          if(!\$request){");
                fwrite($sf, "\n              throw new Exception(\"Invalid Request\",404);");
                fwrite($sf, "\n          }");
                fwrite($sf, "\n          \$this->request = \$request;");
                fwrite($sf, "\n          \$this->vc = new VIKCRYPT();");
                fwrite($sf, "\n      }");
                fwrite($sf, "\n      ");
                fwrite($sf, "\n      public function Reply(): array");
                fwrite($sf, "\n      {");
                fwrite($sf, "\n           return array(");
                fwrite($sf, "\n              \"Status\"=>\"Success\",");
                fwrite($sf, "\n              \"StatusCode\"=>200,");
                fwrite($sf, "\n              \"Message\"=>\"" . $service . " Created Successfully!\",");
                fwrite($sf, "\n            );");
                fwrite($sf, "\n      }");
                fwrite($sf, "\n }");
                $this->status = 1;
                print($service." Created Successfully");
            }catch (Exception $e){
                $this->status = 0;
                print_r($e);
                exit(0);
                throw $e;
            }
        }
    }
}