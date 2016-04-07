Feature: Memestime upload
	In order to upload images
	As a facebook user
	I need upload any kind of images

Scenario: Fail to Upload images
	Given I go to "/upload.php"
	When I fill in "btnSeleccionar" with "image.jpg" 
	And  I press "btnSubir"
	Then I reload the page 
	And I should see "Ha ocurrido un error al cargar el archivo: Debes de colocar un nombre para tu publicacion"

Scenario: Success to upload images
	Given I go to "/upload.php"
	When I fill in "btnSeleccionar" with "image.jpg"
	And  I fill in "txtNombre" with "Es un archivo" 
	Then I reload the page 
	

