<?php
namespace DirtyNeedle;

use DirtyNeedle\Exception\ServiceDefinitionNotFound;

class DiContainer
{
    /** @var DiContainer */
    private static $instance;

    /** @var ObjectBuilder */
    private $objectBuilder;

    /** @var object[] */
    private $objects = [];

    /** @var array */
    private $definitions = [];

    private function __construct()
    {
        $this->objectBuilder = new ObjectBuilder();
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
        $this->definitions = [];
    }

    /**
     * @throws ServiceDefinitionNotFound
     *
     * @param $serviceId
     * @return object
     */
    public function get($serviceId)
    {
        if (isset($objects[$serviceId])) {
            return $objects[$serviceId];
        }
        if (!isset($this->definitions[$serviceId])) {
            $exception = new ServiceDefinitionNotFound();
            $exception->setServiceId($serviceId);
            throw $exception;
        }
        return $this->buildObjectFromDefinition($this->definitions[$serviceId]);
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
        $fileContents = require $pathToFile;
        $this->definitions = array_merge($this->definitions, $fileContents['dirty-needle']['services']);
    }

    /**
     * @param array $definitionArray
     * @return object
     */
    private function buildObjectFromDefinition($definitionArray)
    {
        $classname = $definitionArray['class'];
        if (!isset($definitionArray['arguments'])) {
            return new $classname;
        }

        $arguments = [];
        foreach ($definitionArray['arguments'] as $argumentServiceId) {
            $arguments[] = $this->get($argumentServiceId);
        }

        return $this->objectBuilder->buildObject($classname, $arguments);
    }
}
