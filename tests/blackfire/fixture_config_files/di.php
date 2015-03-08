<?php

return array(

    'dirty-needle' => array(

        'simple-class' => array(
            'class' => '\DirtyNeedle\BlackfireTest\FixtureClasses\SimpleClass'
        ),

        'dependency-to-retrieve' => array(
            'class' => '\DirtyNeedle\BlackfireTest\FixtureClasses\ClassWithDependency',
            'arguments' => array(
                'simple-class'
            )
        )

    )

);
