<?php
namespace DirtyNeedle;

class ObjectBuilder
{
    /**
     * @param string $classname
     * @param array  $constructorArguments
     * @return object
     */
    public function buildObject($classname, $constructorArguments)
    {
        return new $classname(...$constructorArguments);
    }
}
