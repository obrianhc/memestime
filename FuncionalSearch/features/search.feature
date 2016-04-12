Feature: Memestime searching
	In order to search images by a name
	As a memestime user
	I need see the results 

Scenario: Searching for "celular"
	Given I go to "/search.php"
	When I fill in "txtBuscar" with "c3lular"
	And I press "btnBuscar"
	Then I should see "celulares de hoy en dia 0"
	
