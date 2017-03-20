<?php 
namespace Demo\Service\Common;

use Pimple\Container;

class DemoContainer extends Container
{
    protected $_instance;

    protected $pool = array();

    protected $configs;

    public function __construct($demo_configs)
    {
        parent::__construct();

        $this->configs = $demo_configs;
    }

    public function boot($options = array())
    {
    }

    public function registerProviders()
    {
    }

    public function createService($name)
    {
        $class = explode(':', $name);

        $module = $class[0];
        $className = $class[1];

        if (empty($this->pool[$className])) {
            $class = "Demo\\Service\\{$module}\\Impl\\{$className}Impl";

            $this->pool[$name] = new $class($this);
        }

        return $this->pool[$name];
    }

    public function createDao($name)
    {
        if (empty($this->pool[$name])) {
            $class = "Demo\\Service\\Dao\\Impl\\{$name}Impl";
            
            $this->pool[$name] = new $class($this);
        }

        return $this->pool[$name];
    }
}