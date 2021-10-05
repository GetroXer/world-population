# world-population

Package processing source feed of world population into database and then it can be reached via API

<H2>Installation:</h2>

* php artisan vendor:publish --provider WorldPopulationServiceProvider
* php artisan migrate
* php artisan worldpopulation:update

<H2>Using:</H2>

* GET http://example.app/world-population/get-population
* Parameteres: page, year, country (code SK,CZ,ZH)
