Feature: Configuring the container and retrieving an object
  In order to get objects for my application
  As a developer building an application using dependency injection
  I want to have a get() method on the container

  Scenario: Retrieving an object from the container
    Given my container is configured with 'sample_di_config.php'
    When I get the service 'simple-class' out of the container
    Then the result should be an instance of '\DirtyNeedle\TestFixtures\NestedDependencies\ClassWithNoDependencies'
