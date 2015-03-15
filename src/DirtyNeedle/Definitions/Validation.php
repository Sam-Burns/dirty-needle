<?php
namespace DirtyNeedle\Definitions;

use DirtyNeedle\Configuration\DiConfig;
use DirtyNeedle\Exception\ServiceDefinitionNotFound;
use DirtyNeedle\Exception\CyclicDependencyInDiConfig;

class Validation
{
    /**
     * @throws ServiceDefinitionNotFound
     * @throws CyclicDependencyInDiConfig
     *
     * @param string   $serviceId
     * @param DiConfig $diConfig
     */
    public function validateServiceRequested($serviceId, DiConfig $diConfig)
    {
        $this->checkServiceIsDefined($serviceId, $diConfig);
        $this->checkForCyclicDependencies($serviceId, $diConfig);
    }

    /**
     * @throws ServiceDefinitionNotFound
     *
     * @param string   $serviceId
     * @param DiConfig $diConfig
     */
    private function checkServiceIsDefined($serviceId, DiConfig $diConfig)
    {
        if (!$diConfig->serviceIsDefined($serviceId)) {
            throw ServiceDefinitionNotFound::constructWithServiceId($serviceId);
        }
    }

    /**
     * @throws CyclicDependencyInDiConfig
     *
     * @param string   $serviceId
     * @param DiConfig $diConfig
     */
    private function checkForCyclicDependencies($serviceId, DiConfig $diConfig)
    {
        $this->cyclicDependencyTest($diConfig, $serviceId, $serviceId, []);
    }

    /**
     * @throws CyclicDependencyInDiConfig
     *
     * @param DiConfig $diConfig
     * @param string   $originallyRequestedServiceId
     * @param string   $serviceIdToTest
     * @param array    $parentDependencies
     */
    private function cyclicDependencyTest(DiConfig $diConfig, $originallyRequestedServiceId, $serviceIdToTest, $parentDependencies)
    {
        if (in_array($serviceIdToTest, $parentDependencies)) {
            throw CyclicDependencyInDiConfig::constructWithServiceId($originallyRequestedServiceId);
        }
        foreach ($diConfig->getArguments($serviceIdToTest) as $childDependencyId) {
            $this->cyclicDependencyTest(
                $diConfig,
                $originallyRequestedServiceId,
                $childDependencyId,
                array_merge($parentDependencies, [$serviceIdToTest])
            );
        }
    }
}
