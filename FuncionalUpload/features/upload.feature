Feature: Memestime upload
	In order to upload images
	As a facebook user
	I need upload any kind of images

Scenario: Upload images
	Given I go to "/upload.php"
	When I fill in "btnSeleccionar" with "image.jpg" 
	And  I fill in "txtNombre" with "Es un archivo" 
	And  I press "btnSubir"
	Then I should see "Se ha cargado correctamente el archivo con exito. ,:)"