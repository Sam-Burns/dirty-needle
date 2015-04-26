<?php
namespace DirtyNeedle;

use DirtyNeedle\Definitions\ServiceId;
use DirtyNeedle\ObjectBuilding\ObjectBuilder;
use DirtyNeedle\Definitions\Validation;
use DirtyNeedle\Configuration\DiConfig;
use DirtyNeedle\Exception\ServiceDefinitionNotFound;
use DirtyNeedle\Exception\CyclicDependencyInDiConfig;
use DirtyNeedle\Exception\DiConfigNotFound;
use DirtyNeedle\Exception\DiConfigNotReadable;
use DirtyNeedle\ObjectBuilding\ObjectBuilderFactory;

class DiContainer
{
    /** @var DiContainer */
    protected static $instance;

    /** @var ObjectBuilder */
    protected $objectBuilder;

    /** @var object[] */
    protected $objects = [];

    /** @var DiConfig */
    protected $diConfig;

    /** @var Validation */
    protected $validation;

    protected function __construct()
    {
        $objectBuilderFactory = new ObjectBuilderFactory();
        $this->objectBuilder = $objectBuilderFactory->getObjectBuilder();
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
     * @param string $serviceIdString
     * @return object
     */
    public function get($serviceIdString)
    {
        $serviceId = new ServiceId($serviceIdString);

        if (isset($this->objects[(string)$serviceId])) {
            return $this->objects[(string)$serviceId];
        }

        $this->validation->validateServiceRequested($serviceId, $this->diConfig);

        return $this->buildObject($serviceId);
    }

    /**
     * @param $serviceIdString
     * @param $object
     */
    public function set($serviceIdString, $object)
    {
        $serviceId = new ServiceId($serviceIdString);
        $this->objects[(string)$serviceId] = $object;
    }

    /**
     * @throws DiConfigNotFound
     * @throws DiConfigNotReadable
     *
     * @param string $pathToFile
     */
    public function addConfigFile($pathToFile)
    {
        $this->diConfig->addConfigFile($pathToFile);
    }

    /**
     * @param ServiceId $serviceId
     * @return object
     */
    private function buildObject(ServiceId $serviceId)
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
