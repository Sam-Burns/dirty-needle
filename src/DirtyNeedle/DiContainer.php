<?php
namespace DirtyNeedle;

class DiContainer
{
    /** @var object[] */
    private $objects = [];

    private $definitions = [];

    /**
     * @param $serviceId
     * @return object
     */
    public function get($serviceId)
    {
        if (isset($objects[$serviceId])) {
            return $objects[$serviceId];
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

        return new $classname(...$arguments);
    }
}
