Feature: Memestime upload
	In order to upload images
	As a facebook user
	I need upload any kind of images

Scenario: Success to upload images
	Given I go to "/upload.php"
	When I upload the image "/FuncionalUpload/ghibli.jpg" 
	And  I fill in "txtNombre" with "Es un archivo" 
	Then I reload the page 
	And I should see "Se ha cargado correctamente el archivo con exito. : Archivo subido al repositorio , :)"
	

