<?php
namespace DirtyNeedle\TestFixtures\NestedDependencies;

use DirtyNeedle\TestFixtures\Simple\SimpleDependency;

class ClassWithOneDependency
{
    /**
     * @param SimpleDependency $simpleDependency
     */
    public function __construct(SimpleDependency $simpleDependency)
    {
    }
}
