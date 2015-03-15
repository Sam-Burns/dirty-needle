<?php
namespace DirtyNeedle\Exception;

class AnonymousService extends DirtyNeedleException
{
    /**
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct();
        $this->message = 'A service exists in the config file with no Service ID';
    }
}
