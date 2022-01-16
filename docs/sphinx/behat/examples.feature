Feature: Examples
  @logic
  Scenario Outline: Examples for phptailors/logic
    Given I tested <example_file> with PHPUnit
    Then I should see PHPUnit stdout from <stdout_file>
    And I should see stderr from <stderr_file>
    And I should see exit code <exit_code>

    Examples:
      | example_file                            | stdout_file                                | stderr_file                                    | exit_code |
