<?php
namespace DirtyNeedle;

use DirtyNeedle\Exception\DiConfigNotFound;
use DirtyNeedle\Exception\DiConfigNotReadable;

class DiConfig
{
    /** @var array */
    private $definitions = array();

    /**
     * @throws DiConfigNotFound
     * @throws DiConfigNotReadable
     *
     * @param string $pathToFile
     */
    public function addConfigFile($pathToFile)
    {
        $this->definitions = array_merge($this->definitions, $this->getSettingsInFile($pathToFile));
    }

    /**
     * @throws DiConfigNotFound
     * @throws DiConfigNotReadable
     *
     * @param string $path
     * @return array
     */
    private function getSettingsInFile($path)
    {
        if (!is_readable($path)) {
            throw DiConfigNotReadable::constructWithFilename($path);
        }
        $fileContents = require $path;
        if (
            !is_array($fileContents) ||
            !isset($fileContents['dirty-needle']) ||
            !is_array($fileContents['dirty-needle'])
        ) {
            throw DiConfigNotFound::constructWithFilename($path);
        }
        return $fileContents['dirty-needle'];
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
