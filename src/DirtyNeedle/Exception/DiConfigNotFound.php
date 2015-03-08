<?php
namespace DirtyNeedle\Exception;

class DiConfigNotFound extends DirtyNeedleException
{
    /**
     * @param string $filename
     * @return static
     */
    public static function constructWithFilename($filename)
    {
        $exception = new static();
        $exception->message = 'File named "' . $filename . '" does not contain configuration for Dirty Needle dependency injection';
        return $exception;
    }
}
