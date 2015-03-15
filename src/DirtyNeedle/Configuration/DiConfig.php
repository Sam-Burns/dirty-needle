<?php
namespace DirtyNeedle\Configuration;

use DirtyNeedle\Definitions\ServiceDefinition;
use DirtyNeedle\Exception\ClassnameNotSpecifiedForDependency;
use DirtyNeedle\Exception\DiConfigNotFound;
use DirtyNeedle\Exception\DiConfigNotReadable;
use DirtyNeedle\Exception\ServiceDefinitionNotFound;

class DiConfig
{
    /** @var ServiceDefinition[] */
    private $definitions = array();

    /**
     * @throws DiConfigNotFound
     * @throws DiConfigNotReadable
     *
     * @param string $pathToFile
     */
    public function addConfigFile($pathToFile)
    {
        $this->definitions = array_merge($this->definitions, $this->getServiceDefinitionsFromFile($pathToFile));
    }

    /**
     * @throws DiConfigNotFound
     * @throws DiConfigNotReadable
     *
     * @param string $path
     * @return ServiceDefinition[]
     */
    private function getServiceDefinitionsFromFile($path)
    {
        $this->checkFileIsReadable($path);

        $fileContents = require $path;

        $this->checkFileContentsIncludesDiConfig($fileContents, $path);

        return $this->convertFileContentsToServiceDefinitions($fileContents);
    }

    /**
     * @throws DiConfigNotReadable
     *
     * @param string $path
     */
    private function checkFileIsReadable($path)
    {
        if (!is_readable($path)) {
            throw DiConfigNotReadable::constructWithFilename($path);
        }
    }

    /**
     * DiConfigNotFound
     *
     * @param mixed  $fileContents
     * @param string $path
     */
    private function checkFileContentsIncludesDiConfig($fileContents, $path)
    {
        if (
            !is_array($fileContents) ||
            !isset($fileContents['dirty-needle']) ||
            !is_array($fileContents['dirty-needle'])
        ) {
            throw DiConfigNotFound::constructWithFilename($path);
        }
    }

    /**
     * @param array $fileContents
     * @return ServiceDefinition[]
     */
    private function convertFileContentsToServiceDefinitions($fileContents)
    {
        $serviceDefinitions = [];
        foreach ($fileContents['dirty-needle'] as $serviceId => $serviceDefinitionArray) {
            $serviceDefinitions[$serviceId] = new ServiceDefinition($serviceId, $serviceDefinitionArray);
        };
        return $serviceDefinitions;
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
        return $this->definitions[$serviceId]->getClass();
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
        return $this->definitions[$serviceId]->getArguments();
    }

    /**
     * @throws ServiceDefinitionNotFound
     *
     * @param string $serviceId
     * @return bool
     */
    public function serviceHasNoArguments($serviceId)
    {
        return !$this->definitions[$serviceId]->hasArguments();
    }

    public function reset()
    {
        $this->definitions = [];
    }
}
