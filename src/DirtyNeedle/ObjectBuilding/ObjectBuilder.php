<?php
namespace DirtyNeedle\ObjectBuilding;

class ObjectBuilder
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
