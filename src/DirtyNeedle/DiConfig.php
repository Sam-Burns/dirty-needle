<?php
namespace DirtyNeedle;

class DiConfig
{
    /** @var array */
    private $definitions = array();

    /**
     * @param string $pathToFile
     */
    public function addConfigFile($pathToFile)
    {
        $fileContents = require $pathToFile;
        $this->definitions = array_merge($this->definitions, $fileContents['dirty-needle']);
    }

    /**
     * @param string $serviceId
     * @return bool
     */
    public function serviceIsDefined($serviceId)
    {
        return isset($this->definitions[$serviceId]);
    }

    /**
     * @param string $serviceId
     * @return string
     */
    public function getClassname($serviceId)
    {
        return $this->definitions[$serviceId]['class'];
    }

    /**
     * @param string $serviceId
     * @return string[]
     */
    public function getArguments($serviceId)
    {
        if (!$this->serviceHasNoArguments($serviceId)) {
            return $this->definitions[$serviceId]['arguments'];
        }
        return [];
    }

    /**
     * @param string $serviceId
     * @return bool
     */
    public function serviceHasNoArguments($serviceId)
    {
        return !isset($this->definitions[$serviceId]['arguments']);
    }

    public function reset()
    {
        $this->definitions = [];
    }
}
