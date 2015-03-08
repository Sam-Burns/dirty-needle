<?php
namespace DirtyNeedle\Exception;

class AnonymousService extends DirtyNeedleException
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct();
        $this->message = 'A service exists in the config file with no Service ID';
    }
}