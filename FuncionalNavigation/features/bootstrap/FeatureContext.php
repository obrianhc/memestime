<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

    class FeatureContext extends MinkContext
    {
        /**
         * @When /^I click li option "([^"]*)"$/
         *
         * @param $text
         * @throws \InvalidArgumentException
         */
        public function iClickLiOption($text)
        {
            $session = $this->getSession();
            $element = $session->getPage()->find(
                'xpath',
                $session->getSelectorsHandler()->selectorToXpath('xpath', '*//*[text()="'. $text .'"]')
            );

            if (null === $element) {
                throw new \InvalidArgumentException(sprintf('Cannot find text: "%s"', $text));
            }

            $element->click();
        }
    }
