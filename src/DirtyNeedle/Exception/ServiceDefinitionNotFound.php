<?php
namespace DirtyNeedle\Exception;

use RuntimeException;

class ServiceDefinitionNotFound extends RuntimeException
{
    /**
     * @param string $serviceId
     */
    public function setServiceId($serviceId)
    {
        $this->message = 'Service ID "' . $serviceId . '" not found in DI config.';
    }
}
