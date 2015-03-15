<?php
namespace DirtyNeedle\ObjectBuilding;

interface ObjectBuilder
{
    /**
     * @param string $classname
     * @param array  $constructorArguments
     * @return object
     */
    public function buildObject($classname, $constructorArguments);
}
