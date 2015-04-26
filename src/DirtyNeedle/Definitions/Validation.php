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
     * @param ServiceId $serviceId
     * @param DiConfig  $diConfig
     */
    public function validateServiceRequested(ServiceId $serviceId, DiConfig $diConfig)
    {
        $this->checkServiceIsDefined($serviceId, $diConfig);
        $this->checkForCyclicDependencies($serviceId, $diConfig);
    }

    /**
     * @throws ServiceDefinitionNotFound
     *
     * @param ServiceId $serviceId
     * @param DiConfig  $diConfig
     */
    private function checkServiceIsDefined(ServiceId $serviceId, DiConfig $diConfig)
    {
        if (!$diConfig->serviceIsDefined($serviceId)) {
            throw ServiceDefinitionNotFound::constructWithServiceId($serviceId);
        }
    }

    /**
     * @throws CyclicDependencyInDiConfig
     *
     * @param ServiceId $serviceId
     * @param DiConfig  $diConfig
     */
    private function checkForCyclicDependencies(ServiceId $serviceId, DiConfig $diConfig)
    {
        $this->cyclicDependencyTest($diConfig, $serviceId, $serviceId, []);
    }

    /**
     * @throws CyclicDependencyInDiConfig
     *
     * @param DiConfig    $diConfig
     * @param ServiceId   $originallyRequestedServiceId
     * @param ServiceId   $serviceIdToTest
     * @param ServiceId[] $parentDependencies
     */
    private function cyclicDependencyTest(
        DiConfig $diConfig,
        ServiceId $originallyRequestedServiceId,
        ServiceId $serviceIdToTest,
        $parentDependencies
    ) {
        if (in_array($serviceIdToTest, $parentDependencies)) {
            throw CyclicDependencyInDiConfig::constructWithServiceId($originallyRequestedServiceId);
        }
        foreach ($diConfig->getArguments($serviceIdToTest) as $childDependencyId) {
            $this->cyclicDependencyTest(
                $diConfig,
                $originallyRequestedServiceId,
                $childDependencyId,
                $this->mergeArrays($parentDependencies, [$serviceIdToTest])
            );
        }
    }

    /**
     * @param ServiceId $serviceIdArray1
     * @param ServiceId $serviceIdArray2
     * @return ServiceId[]
     */
    private function mergeArrays($serviceIdArray1, $serviceIdArray2)
    {
        $mergedArray = [];

        foreach ($serviceIdArray1 as $serviceId) {
            $mergedArray[(string)$serviceId] = $serviceId;
        }

        foreach ($serviceIdArray2 as $serviceId) {
            $mergedArray[(string)$serviceId] = $serviceId;
        }

        return $mergedArray;
    }
}
