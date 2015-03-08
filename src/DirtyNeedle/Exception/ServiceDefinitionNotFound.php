<?php
namespace DirtyNeedle\Exception;

use RuntimeException;

class ServiceDefinitionNotFound extends RuntimeException
{
    /**
     * @param string $serviceId
     * @return static
     */
    public static function constructWithServiceId($serviceId)
    {
        $exception = new static();
        $exception->message = 'Service ID "' . $serviceId . '" not found in DI config.';
        return $exception;
    }
}
