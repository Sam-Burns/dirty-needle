<?php
namespace DirtyNeedle\Exception;

use DirtyNeedle\Definitions\ServiceId;

class ClassnameNotSpecifiedForDependency extends DirtyNeedleException
{
    /**
     * @param ServiceId $serviceId
     * @return static
     */
    public static function constructWithServiceId(ServiceId $serviceId)
    {
        $exception = new static();
        $exception->message = 'Classname not specified for service with ID "' . $serviceId . '"';
        return $exception;
    }
}
