<?php
namespace DirtyNeedle\BlackfireTest\FixtureClasses;

class ClassWithDependency
{
    /**
     * @param SimpleClass $simpleClass
     */
    public function __construct(SimpleClass $simpleClass)
    {
    }
}
