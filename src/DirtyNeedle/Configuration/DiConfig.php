<?php
namespace DirtyNeedle\Configuration;

use DirtyNeedle\Definitions\ServiceDefinition;
use DirtyNeedle\Definitions\ServiceId;
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
            $serviceDefinitions[$serviceId] = new ServiceDefinition(new ServiceId($serviceId), $serviceDefinitionArray);
        };
        return $serviceDefinitions;
    }

    /**
     * @param ServiceId $serviceId
     * @return bool
     */
    public function serviceIsDefined(ServiceId $serviceId)
    {
        return isset($this->definitions[(string)$serviceId]);
    }

    /**
     * @throws ServiceDefinitionNotFound
     * @throws ClassnameNotSpecifiedForDependency
     *
     * @param ServiceId $serviceId
     * @return string
     */
    public function getClassname(ServiceId $serviceId)
    {
        if (!$this->serviceIsDefined($serviceId)) {
            throw ServiceDefinitionNotFound::constructWithServiceId($serviceId);
        }
        return $this->definitions[(string)$serviceId]->getClass();
    }

    /**
     * @throws ServiceDefinitionNotFound
     *
     * @param ServiceId $serviceId
     * @return string[]
     */
    public function getArguments(ServiceId $serviceId)
    {
        if (!$this->serviceIsDefined($serviceId)) {
            throw ServiceDefinitionNotFound::constructWithServiceId($serviceId);
        }
        return $this->definitions[(string)$serviceId]->getArguments();
    }

    /**
     * @throws ServiceDefinitionNotFound
     *
     * @param ServiceId $serviceId
     * @return bool
     */
    public function serviceHasNoArguments(ServiceId $serviceId)
    {
        return !$this->definitions[(string)$serviceId]->hasArguments();
    }

    public function reset()
    {
        $this->definitions = [];
    }
}
