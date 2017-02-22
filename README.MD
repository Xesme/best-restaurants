# Best Restaurant Database

#### _A webpage that simulates a best restaurant database, 21 February 2017_

#### By _**Xia Amendolara & Philip Putnam**_

## Description

This webpage will allow a user to enter information about restaurants they have visited and enter information about said restaurants such as: type of cuisine, name of restaurant, rating, and review.

## Setup/Installation Requirements

1. _Fork and clone this repository from_ [gitHub]https://github.com/xesme/best-restaurant.
2. Run `composer install --prefer-source --no-interaction` from project root
3. Create a local server in the /web directory within the project folder using the command: `php -S localhost:8000`
4. Open the directory http://localhost:8000/ in any standard web browser.


## Specifications

|Behavior|Input|Output|
|--------|-----|------|
|User can add a new cuisine to database | "American" | "American" |
|User can add a new restaurant to database | "Bob's Burgers" | "Bob's Burger's" |
|User can view all cuisines | click button | "American, Thai, Mexican"|
|User can view all restaurants |clicks button | "Bob's Burgers, Basil Thai, Los Gorditos"|
|User can delete all stored information in databases| click delete all button | " "|
|User edit restaurant information | "Bob's Burgers" = "Burger Bob"| "Burger Bob"|
|User can view restaurants by cuisine | user clicks "American" | "Burger Bob"|



## Known Bugs

No known bugs.

## Support and contact details

Please contact XiaEsmeAmen@me.com or putnamp989@gmail.com with questions or concerns.

## Technologies Used

* _HTML_
* _CSS_
* _Bootstrap_
* _PHP_
* _Silex_
* _Twig_
* _Composer_

## License

*MIT license*

Copyright (c) 2017 {**Xia Amendolara & Philip Putnam**} All Rights Reserved.
