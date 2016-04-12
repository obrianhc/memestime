Feature: Memestime Navigation
	In order to navigate between images
	As a facebook user
	I need see images when i click on them


Scenario: Navigation
	Given I am on "/index.php"
	Then  I should see "Memestime"
	And I follow "Todos a bordo del tren de la rikura"
        Then I should see "Todos a bordo del tren de la rikura"
