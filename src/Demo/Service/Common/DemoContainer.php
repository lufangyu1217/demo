<?php 
namespace Demo\Service\Common;

use Pimple\Container;
use Demo\Service\Common\ContainerCall;
use Doctrine\DBAL\DriverManager;

class DemoContainer extends Container
{
    protected $_instance;

    private $config = array();

    public function __construct($demo_configs)
    {
        parent::__construct();

        if (empty($this->config)) {
            $this->config = $demo_configs;
        }

        $this['service'] = function($container) {
            return function ($module, $name) use ($container) {
                $class = "Demo\\Service\\{$module}\\Impl\\{$name}Impl";

                return new $class($container);
            };
        };

        $this['dao'] = function($container) {
            return function ($module, $name) use ($container) {
                $class = "Demo\\Service\\{$module}\\Dao\\Impl\\{$name}Impl";

                return new $class($container);
            };
        };

        $this['call'] = function($container) {
            return new ContainerCall(
                array(
                    'service' => $container['service'],
                    'dao'     => $container['dao']
                )
            );
        };

        $this['db'] = function ($container) {
            $database_config = $container->config['database'];

            return DriverManager::getConnection(array(
                'dbname'       => $database_config['name'],
                'user'         => $database_config['user'],
                'password'     => $database_config['password'],
                'host'         => $database_config['host'],
                'driver'       => $database_config['driver'],
                'charset'      => $database_config['charset']
            ));
        };
    }

    public function registerProviders()
    {
    }

    public function createService($name)
    {
        return $this['call']->call($name, 'service');
    }

    public function createDao($name)
    {
        return $this['call']->call($name, 'dao');
    }

    private function getContainerCall()
    {
        return new ContainerCall();
    }
}