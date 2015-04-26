<?php
namespace DirtyNeedle\Definitions;

use DirtyNeedle\Exception\ClassnameNotSpecifiedForDependency;

class ServiceDefinition
{
    /** @var array */
    private $definitionArray;

    /** @var string */
    private $serviceId;

    /**
     * @param ServiceId $serviceId
     * @param array     $definitionArray
     */
    public function __construct(ServiceId $serviceId, $definitionArray)
    {
        $this->definitionArray = $definitionArray;

        $argumentsToUse = [];

        if (isset($this->definitionArray['arguments'])) {
            foreach ($this->definitionArray['arguments'] as $argument) {
                $argumentsToUse[] = new ServiceId($argument);
            }
            $this->definitionArray['arguments'] = $argumentsToUse;
        } else {
            $this->definitionArray['arguments'] = [];
        }

        $this->serviceId = $serviceId;
    }

    /**
     * @throws ClassnameNotSpecifiedForDependency
     *
     * @return string
     */
    public function getClass()
    {
        if (!isset($this->definitionArray['class']) || strlen($this->definitionArray['class']) == 0) {
            throw ClassnameNotSpecifiedForDependency::constructWithServiceId($this->serviceId);
        }
        return $this->definitionArray['class'];
    }

    /**
     * @return string[]
     */
    public function getArguments()
    {
        if (!$this->hasArguments()) {
            return [];
        }
        return $this->definitionArray['arguments'];
    }

    /**
     * @return bool
     */
    public function hasArguments()
    {
        return isset($this->definitionArray['arguments']);
    }
}
