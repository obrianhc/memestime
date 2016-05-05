Feature: Memestime Navigation
	In order to navigate between images
	As a facebook user
	I need see images when i click on them


Scenario: Navigation
	Given I am on "/index.php"
	Then  I should see "mi creacion"
	And I follow "Ver"
        Then I should see "yo naci en la rikura"
