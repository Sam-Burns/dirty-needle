<?php
namespace DirtyNeedle;

use DirtyNeedle\Exception\ServiceDefinitionNotFound;
use DirtyNeedle\Exception\CyclicDependencyInDiConfig;

class DiContainer
{
    /** @var DiContainer */
    private static $instance;

    /** @var ObjectBuilder */
    private $objectBuilder;

    /** @var object[] */
    private $objects = [];

    /** @var DiConfig */
    private $diConfig;

    /** @var Validation */
    private $validation;

    private function __construct()
    {
        $this->objectBuilder = new ObjectBuilder();
        $this->diConfig = new DiConfig();
        $this->validation = new Validation();
    }

    /**
     * @return DiContainer
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function reset()
    {
        $this->objects = [];
        $this->diConfig->reset();
    }

    /**
     * @throws ServiceDefinitionNotFound
     * @throws CyclicDependencyInDiConfig
     *
     * @param $serviceId
     * @return object
     */
    public function get($serviceId)
    {
        if (isset($objects[$serviceId])) {
            return $objects[$serviceId];
        }

        $this->validation->validateServiceRequested($serviceId, $this->diConfig);

        return $this->buildObject($serviceId);
    }

    /**
     * @param $serviceId
     * @param $object
     */
    public function set($serviceId, $object)
    {
        $this->objects[$serviceId] = $object;
    }

    /**
     * @param string $pathToFile
     */
    public function addConfigFile($pathToFile)
    {
        $this->diConfig->addConfigFile($pathToFile);
    }

    /**
     * @param string $serviceId
     * @return object
     */
    private function buildObject($serviceId)
    {
        $classname = $this->diConfig->getClassname($serviceId);
        if ($this->diConfig->serviceHasNoArguments($serviceId)) {
            return new $classname;
        }

        $arguments = [];
        foreach ($this->diConfig->getArguments($serviceId) as $argumentServiceId) {
            $arguments[] = $this->get($argumentServiceId);
        }

        return $this->objectBuilder->buildObject($classname, $arguments);
    }
}
