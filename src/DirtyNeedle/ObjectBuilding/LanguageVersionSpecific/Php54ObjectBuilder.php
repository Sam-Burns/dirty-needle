<?php
namespace DirtyNeedle\ObjectBuilding\LanguageVersionSpecific;

use DirtyNeedle\ObjectBuilding\ObjectBuilder;

/**
 * This class is instantiated by the ObjectBuilderFactory class.  It should only be autoloaded in < PHP5.6.0
 */
class Php54ObjectBuilder implements ObjectBuilder
{
    /**
     * @param string $classname
     * @param array  $constructorArguments
     * @return object
     */
    public function buildObject($classname, $constructorArguments)
    {
        if (!count($constructorArguments)) {
            return new $classname;
        }
        $reflectionClass = new \ReflectionClass($classname);
        return $reflectionClass->newInstanceArgs($constructorArguments);
    }
}
