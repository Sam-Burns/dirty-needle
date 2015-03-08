<?php
namespace DirtyNeedle;

use DirtyNeedle\Exception\ClassnameNotSpecifiedForDependency;
use DirtyNeedle\Exception\DiConfigNotFound;
use DirtyNeedle\Exception\DiConfigNotReadable;
use DirtyNeedle\Exception\ServiceDefinitionNotFound;

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
     * @throws ServiceDefinitionNotFound
     * @throws ClassnameNotSpecifiedForDependency
     *
     * @param string $serviceId
     * @return string
     */
    public function getClassname($serviceId)
    {
        if (!$this->serviceIsDefined($serviceId)) {
            throw ServiceDefinitionNotFound::constructWithServiceId($serviceId);
        }
        if (!isset($this->definitions[$serviceId]['class'])) {
            throw ClassnameNotSpecifiedForDependency::constructWithServiceId($serviceId);
        }
        return $this->definitions[$serviceId]['class'];
    }

    /**
     * @throws ServiceDefinitionNotFound
     *
     * @param string $serviceId
     * @return string[]
     */
    public function getArguments($serviceId)
    {
        if (!$this->serviceIsDefined($serviceId)) {
            throw ServiceDefinitionNotFound::constructWithServiceId($serviceId);
        }
        if (!$this->serviceHasNoArguments($serviceId)) {
            return $this->definitions[$serviceId]['arguments'];
        }
        return [];
    }

    /**
     * @throws ServiceDefinitionNotFound
     *
     * @param string $serviceId
     * @return bool
     */
    public function serviceHasNoArguments($serviceId)
    {
        if (!$this->serviceIsDefined($serviceId)) {
            throw ServiceDefinitionNotFound::constructWithServiceId($serviceId);
        }
        return !isset($this->definitions[$serviceId]['arguments']);
    }

    public function reset()
    {
        $this->definitions = [];
    }
}
