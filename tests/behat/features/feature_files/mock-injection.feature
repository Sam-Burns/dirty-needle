Feature: Injecting a mock object
  In order to test that my application works
  As a developer building an application using dependency injection
  I want to inject mock objects into my container

  Scenario: Injecting a mock into the container
    Given my container is configured with 'sample_di_config.php'
    And I inject a mock '\DirtyNeedle\TestFixtures\NestedDependencies\ClassWithNoDependencies' into the container as service ID 'simple-class'
    When I get the service 'simple-class' out of the container
    Then the result should be an instance of a mock object
