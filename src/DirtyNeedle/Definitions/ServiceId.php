<?php
namespace DirtyNeedle\Definitions;

use DirtyNeedle\Exception\AnonymousService;

class ServiceId
{
    /** @var string */
    private $serviceIdAsString;

    /**
     * @param string $serviceIdAsString
     */
    public function __construct($serviceIdAsString)
    {
        if ($serviceIdAsString == '') {
            throw new AnonymousService();
        }
        $this->serviceIdAsString = (string)$serviceIdAsString;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->serviceIdAsString;
    }
}
