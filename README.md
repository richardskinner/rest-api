# rest-api
A REST API using raw PHP and OOP principles

### To Get Started
* Install Docker
* Install packages via composer
* Run `cd docker-base-development`, `./start-script` to create a network for docker to run on
* Return to root directory and run `docker-compose up -d` to start server

#### OAuth2 
Could have used `bshaffer/oauth2-server-php` for a more secure experience, creating tokens and saving to a DB and applying the correct timestamps etc.
But for the purpose of test we hardcoded a token.
