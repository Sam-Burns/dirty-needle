<?php
namespace DirtyNeedle\Exception;

use RuntimeException;

class CyclicDependencyInDiConfig extends RuntimeException
{
    /**
     * @param string $serviceId
     */
    public function setServiceId($serviceId)
    {
        $this->message = 'Cyclic dependency found while trying to retrieve "' . $serviceId . '" from container';
    }
}
