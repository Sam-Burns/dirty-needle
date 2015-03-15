<?php
namespace DirtyNeedle\TestFixtures\IllegalCyclicDependencies;

class ClassA
{
    public function __construct(ClassB $dependency)
    {
    }
}
