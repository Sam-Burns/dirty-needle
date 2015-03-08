<?php

return array(

    'dirty-needle' => array(

        'simple-class' => array(
            'class' => '\DirtyNeedle\PhpunitTest\FixtureClasses\ClassWithNoDependencies'
        ),

        'simple-dependency' => array(
            'class' => '\DirtyNeedle\PhpunitTest\FixtureClasses\SimpleDependency'
        ),

        'class-with-one-dependency' => array(
            'class' => '\DirtyNeedle\PhpunitTest\FixtureClasses\ClassWithOneDependency',
            'arguments' => array(
                'simple-dependency'
            )
        ),

    )

);
