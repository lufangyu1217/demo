<?php 
namespace Demo\Service\Common;


class ContainerCall
{
    private $pool = array();

    private $container;

    private $makers = array();

    public function __construct(array $makers)
    {
        $this->makers = $makers;
    }

    public function call($name, $type)
    {
        $class = explode(':', $name);
        $module = $class[0];
        $className = $class[1];
        $type = ucfirst($type);

        // if (empty($this->pool[$className])) {
        //     $class = "Demo\\{$type}\\{$module}\\Impl\\{$className}Impl";

        //     $this->pool[$name] = new $class($this);
        // }

        $maker = $this->makers[lcfirst($type)];

        if (empty($this->pool[lcfirst($type)][$name])) {
            $obj = $maker($module, $className);
            $this->pool[lcfirst($type)][$name] = $obj;
        }

        return $this->pool[lcfirst($type)][$name];
    }
}