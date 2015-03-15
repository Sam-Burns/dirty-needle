<?php
namespace DirtyNeedle\TestFixtures\IllegalCyclicDependencies;

class ClassB
{
    public function __construct(ClassC $dependency)
    {
    }
}
