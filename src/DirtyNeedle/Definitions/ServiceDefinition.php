<?php
namespace DirtyNeedle\Definitions;

use DirtyNeedle\Exception\AnonymousService;
use DirtyNeedle\Exception\ClassnameNotSpecifiedForDependency;

class ServiceDefinition
{
    /** @var array */
    private $definitionArray;

    /** @var string */
    private $serviceId;

    /**
     * @param string $serviceId
     * @param array  $definitionArray
     */
    public function __construct($serviceId, $definitionArray)
    {
        if (!(is_string($serviceId) && strlen($serviceId) >= 1)) {
            throw new AnonymousService;
        }
        $this->definitionArray = $definitionArray;
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
