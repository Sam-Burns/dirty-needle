<?php
namespace DirtyNeedle\TestFixtures\IllegalCyclicDependencies;

class ClassC
{
    public function __construct(ClassA $dependency)
    {
    }
}
