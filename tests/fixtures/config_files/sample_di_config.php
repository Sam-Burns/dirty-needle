<?php

return array(

    'dirty-needle' => array(

        'simple-class' => array(
            'class' => '\DirtyNeedle\TestFixtures\NestedDependencies\ClassWithNoDependencies'
        ),

        'simple-dependency' => array(
            'class' => '\DirtyNeedle\TestFixtures\Simple\SimpleDependency'
        ),

        'class-with-one-dependency' => array(
            'class' => '\DirtyNeedle\TestFixtures\NestedDependencies\ClassWithOneDependency',
            'arguments' => array(
                '@simple-dependency'
            )
        ),

    )

);
