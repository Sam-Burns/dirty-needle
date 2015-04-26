<?php

return array(

    'dirty-needle' => array(

        'class-a' => array(
            'class' => '\DirtyNeedle\TestFixtures\IllegalCyclicDependencies\ClassA',
            'arguments' => array(
                '@class-b'
            )
        ),

        'class-b' => array(
            'class' => '\DirtyNeedle\TestFixtures\IllegalCyclicDependencies\ClassB',
            'arguments' => array(
                '@class-c'
            )
        ),

        'class-c' => array(
            'class' => '\DirtyNeedle\TestFixtures\IllegalCyclicDependencies\ClassC',
            'arguments' => array(
                '@class-a'
            )
        ),

    )

);
