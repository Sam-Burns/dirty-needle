<?php
namespace DirtyNeedle\Exception;

class ServiceDefinitionNotFound extends DirtyNeedleException
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
