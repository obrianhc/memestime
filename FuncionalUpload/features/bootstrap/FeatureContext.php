<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

/**
   * @Then /^I upload the image "([^"]*)"$/
   */
  public function iUploadTheImage($path) {
    // Cannot use the build in MinkExtension function 
    // because the id of the file input field constantly changes and the input field is hidden
    if ($this->getMinkParameter('files_path')) {
      $fullPath = rtrim(realpath($this->getMinkParameter('files_path')), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$path;
      
      if (is_file($fullPath)) {
        $fileInput = 'input[type="file"]';
        $field = $this->getSession()->getPage()->find('jpg', $fileInput);

        if (null === $field) {
           throw new Exception("File input is not found");
        }
        $field->attachFile($fullPath);
      }
    }
    else throw new Exception("File is not found at the given location");      
  }


}