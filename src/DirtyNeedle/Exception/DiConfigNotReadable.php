<?php
namespace DirtyNeedle\Exception;

class DiConfigNotReadable extends DirtyNeedleException
{
    /**
     * @param string $filename
     * @return static
     */
    public static function constructWithFilename($filename)
    {
        $exception = new static();
        $exception->message = 'File named "' . $filename . '" is not readable';
        return $exception;
    }
}
