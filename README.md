# No PHP Framework


## License

This code is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

##Installation

Step1: cd into project and run <code>php ./composer.phar install</code>. Decided to try playing around with doctrine a bit so 
installed symfony/orm-pack as the only dependency.

Step2: create a database called story (current config assumes a local database is running, to change go into bootstrap/app.php
and change doctrine settings)

Step3: run <code>vendor/bin/doctrine orm:schema-tool:create</code> to create the logs schema

##Participants
At start all story participants are initialized with random values. In my example we have the following parties.
1. Hero
2. Mob (in initial description there wa a class People having BadPeople/GoodPeople) since i couldn't figure out 
the purpouse for GoodPeople i decided to only have BadPeople and rename it to Mob
3. Earth, since daytime/nightime cycle is relative to a place on a planet i needed a planet to have it be
day or night. 
4. Moon
5. Sun  

##Persistence
Currently only the Logs are persisted to the DB

## Test Story
There's some planets(Moon, Sun) in this scenario the Mob(or Bad People) went ahead and stole on or both these planets.
The hero wouldn't have it, and decides to save the planets. The hero has some stats and the mob has som stats so the 
hero doesn't always win(currently no crit chance is developed so the one with higher stats always wins). After the fight 
a log is made of these historical events and the story needs to be told again.

##PS
This is only an alpha release for bugs or features comment on this repo, ty.

Regards.
