<?php
use Codeception\Util\Locator;

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('Test Filtration and Sorting');

$I->amOnPage('/fundraisers');
$I->see('Filtration Catalog', 'h3');
$I->see('Sort', 'h3');

$I->see('Na schronisko dla kotków');
$I->see('5450.45');

$I->see('Na leczenie dla Zosi');
$I->see('45654.65');

$I->see('Wydanie filmu');
$I->see('54322');
/*
$I->selectOption("select", 'Animals');
$I->click('Filter');

$I->dontsee('Na leczenie dla Zosi');
$I->dontsee('45654.65');

$I->dontsee('Wydanie filmu');
$I->dontsee('54322');

$I->click('Show All');

$I->see('Na schronisko dla kotków');
$I->see('5450.45');

$I->see('Na leczenie dla Zosi');
$I->see('45654.65');

$I->see('Wydanie filmu');
$I->see('54322');

$I->fillField('amount_to_be_raised', 'Blad');
$I->see('Please enter a number');
$I->fillField('amount_to_be_raised', '7000');
$I->click('Filter');

$I->dontsee('Na schronisko dla kotków');
$I->dontsee('5450.45');

$I->click('Show All');
*/

$I->click('Amount ↓');

$I->see('Wynalazek',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Odbudowa domu po udeżeniu meteorytu',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Badania',Locator::elementAt('//tbody/tr/td/a', 3));

$I->click('Amount ↑');

$I->see('Koc',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Prezent dla taty',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Wydanie czasopisma',Locator::elementAt('//tbody/tr/td/a', 3));

$I->click('End Date ↑');

$I->see('Prezent dla brata',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Wynalazek',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Piłki do koszykówki',Locator::elementAt('//tbody/tr/td/a', 3));

$I->click('End Date ↓');

$I->see('Odbudowa domu po pożarze',Locator::elementAt('//tbody/tr/td/a', 1));
$I->see('Wydanie filmu',Locator::elementAt('//tbody/tr/td/a', 2));
$I->see('Na leczenie dla Zosi',Locator::elementAt('//tbody/tr/td/a', 3));