<?php
namespace DirtyNeedle\ObjectBuilding;

use DirtyNeedle\ObjectBuilding\LanguageVersionSpecific\Php54ObjectBuilder;
use DirtyNeedle\ObjectBuilding\LanguageVersionSpecific\Php56ObjectBuilder;

class ObjectBuilderFactory
{
    /**
     * @return ObjectBuilder
     */
    public function getObjectBuilder()
    {
        if (version_compare(PHP_VERSION, '5.6.0') >= 0) {
            return new Php56ObjectBuilder();
        } else {
            return new Php54ObjectBuilder();
        }
    }
}
