<?php
namespace DirtyNeedle\Exception;

use RuntimeException;

class CyclicDependencyInDiConfig extends RuntimeException
{
    /**
     * @param string $serviceId
     * @return static
     */
    public static function constructWithServiceId($serviceId)
    {
        $exception = new static();
        $exception->message = 'Cyclic dependency found while trying to retrieve "' . $serviceId . '" from container';
        return $exception;
    }
}
