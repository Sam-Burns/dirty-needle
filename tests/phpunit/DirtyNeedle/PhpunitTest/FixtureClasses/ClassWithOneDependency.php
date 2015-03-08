<?php
namespace DirtyNeedle\PhpunitTest\FixtureClasses;

class ClassWithOneDependency
{
    /**
     * @param SimpleDependency $simpleDependency
     */
    public function __construct(SimpleDependency $simpleDependency)
    {
    }
}
