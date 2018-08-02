# A introduction to the genetic algorithm -> It's not so scary ;)

This mini project was build to show to other PHP/or not devs, a simple usage for a genetic algorithm (GA, for short). GA concepts are not hard to understand but can be scary to turn it to code.

...yes I'm using Lumen framework

A really good article (not so complex) about GA is: http://www.abrandao.com/2015/01/simple-php-genetic-algorithm/ 
Read only the GA concept, the Code part of the article is too messy ;)

## REQUIRED
`Docker`
`Docker Compose`
`Composer`

## Endpoints

War - format JSON:
`localhost:8088/war?json`

War - format HTML:
`localhost:8088/war`

Single fight - format JSON:
`localhost:8088/fight?json`

# Let's Fight

This library will simulate a War between several generations of fighters against a mighty Cyclops. Be careful! :D

The WAR concept is that the first generation of 4 fighters and the two bests will generate 4 children that will also fight the giant. The best fighters are the ones that last more turns against the Cyclops.

Before Go further on the GA related to this WAR, let's see how the fight between one hero vs one beast works:

##The story Once upon a time there was a great Hero, with some strengths and weaknesses, as all heroes have. After battling all kinds of monsters for more than a hundred years, Hero now has the following stats: 
* Health: (e.g 70 - 100)
* Strength: (e.g 70 - 80) 
* Defense: (e.g 45 – 55) 
* Speed: (e.g 40 – 50)
* Luck: (e.g 10% - 30%) (0% means no luck, 100% lucky all the time) Also, he possesses 2 skills: 

```
* Rapid strike: Strike twice while it’s his turn to attack; there’s a 10% chance he’ll use this skill every time he attacks 
* Magic shield: Takes only half of the usual damage when an enemy attack; there’s a 20% chance he’ll use this skill every time he defends
``` 
(*This special skills is not part of the fight/war, but can be activated by uncommented at FightSimulationGeneticAlgorithm/app/Model/Fighters/Hero.php line 30*)

##Gameplay The Hero encounters some wild beasts, with the following properties: 
* Health: (e.g 60 - 90)
* Strength: (e.g 60 - 90) 
* Defense: (e.g 40 – 60) 
* Speed: (e.g 40 – 60) 
* Luck: (e.g 25% - 40%) 

On every battle, the Hero and the beast must be initialized with random properties, within their ranges. The first attack is done by the player with the higher speed. If both players have the same speed than the attack is carried on by the player with the highest luck. After an attack, the players switch roles: the attacker now defends and the defender now attacks. The damage done by the attacker is calculated with the following formula: Damage = Attacker strength – Defender defense The damage is subtracted from the defender’s health. An attacker can miss their hit and do no damage if the defender gets lucky that turn. The Hero’ skills occur randomly, based on their chances, so take them into account on each turn.

##Game over The fight ends when one of the players remain without health or the number of turns reaches 20. The application will output the results per turn and per fight: what happened, which skills were used (if any), the damage done, defender’s health left...etc If we have a winner before the maximum number of rounds is reached, he must be declared.

*I took this fight rules from an article that I read many years ago, I forget the link. Sorry :(*

Go to the endpoint `localhost:8088/fight?json` and see what happen.

# The Big War

Now that we know how a single fight 1 vs 1 works, let's understand the war.

We start with 4 fights with completely randomized stats (health, strength, etc). All these fighters will face individually a mighty Cyclops, during a max period of 20 years (or 20 rounds). Why not more, because after 20 years they will retire and live a happy old live :).

The 2 best fighters for this generation (the ones that last for the bigger amount of turns) will generate 4 new children (fights). These children are a mix of the best stats of both the parents, but there are one stats (e.g health) that is a mutation (it means a randomized number).

The cycle of generations will go on until one this fighters kill the Cyclops. Or we reach a MAX of 30 generations (The Cyclops died because of old age at this point :p).

*Every time you run the war the results will be different ;) *

A really good article (not so complex) about GA is: http://www.abrandao.com/2015/01/simple-php-genetic-algorithm/ 
Read only the GA concept, the Code part of the article is too messy ;)
