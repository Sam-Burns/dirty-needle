<?php
namespace DirtyNeedle\Exception;

class CyclicDependencyInDiConfig extends DirtyNeedleException
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
