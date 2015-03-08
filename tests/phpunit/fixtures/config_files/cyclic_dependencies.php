<?php

return array(

    'dirty-needle' => array(

        'class-a' => array(
            'class' => '\DirtyNeedle\PhpunitTest\FixtureClasses\ClassA',
            'arguments' => array(
                'class-b'
            )
        ),

        'class-b' => array(
            'class' => '\DirtyNeedle\PhpunitTest\FixtureClasses\ClassB',
            'arguments' => array(
                'class-c'
            )
        ),

        'class-c' => array(
            'class' => '\DirtyNeedle\PhpunitTest\FixtureClasses\ClassC',
            'arguments' => array(
                'class-a'
            )
        ),

    )

);
