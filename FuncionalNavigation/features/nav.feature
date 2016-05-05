Feature: Memestime Navigation
	In order to navigate between images
	As a facebook user
	I need see images when i click on them


Scenario: Navigation
	Given I am on "/index.php"
	Then  I should see "matadero vegano "
	And I follow "/image.php?image=572b93db6803fac8038b456f"
        Then I should see "matadero vegano "
