<?php
namespace DirtyNeedle\Exception;

class ClassnameNotSpecifiedForDependency extends DirtyNeedleException
{
    /**
     * @param string $serviceId
     * @return static
     */
    public static function constructWithServiceId($serviceId)
    {
        $exception = new static();
        $exception->message = 'Classname not specified for service with ID "' . $serviceId . '"';
        return $exception;
    }
}
