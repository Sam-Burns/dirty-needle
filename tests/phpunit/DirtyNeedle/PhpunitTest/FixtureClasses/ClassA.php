<?php
namespace DirtyNeedle\PhpunitTest\FixtureClasses;

class ClassA
{
    public function __construct(ClassB $dependency)
    {
    }
}
