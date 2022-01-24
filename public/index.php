<?php
require_once __DIR__.'/../bootstrap/app.php';
use App\Entity\Celestials\CelestialObject;
use App\Entity\Celestials\Sun;
use App\Entity\Celestials\Moon;
use App\Entity\Celestials\Earth;
use App\Router\Router;
use App\Utility\Http;
use App\Entity\TypeDef;
use App\Entity\People\Hero;
use App\Entity\People\Mob;


/**
 * @var \Doctrine\ORM\EntityManager $entityManager
 * @Annotation Added this just for autocompletion
 */
$em = $entityManager;

Router::add('/', function() {
    $hero = Hero::getInstance();

    $mob = new Mob();

    $earth = new Earth();
    $earth->setTimeOfDay(TypeDef::DAY);

    $sun = new Sun();
    $sun->setRelativePlanet($earth);

    $moon = new Moon();
    $moon->setRelativePlanet($earth);

    Http::formResponse([
        $hero->generate(),
        $mob->generate(),
        $earth->generate(),
        $sun->generate(),
        $moon->generate()
    ],200);

});
/**
 * Normally did would go in a service of sorts but i'll put some generic business logic here for this test
 */
Router::add('/', function() use ($em){
    $data = Http::request();
    /**
     * Hero can only see that the sun is missing if it's daytime
     */
        $hero = new Hero(
            $data['Hero']['strength'],
            $data['Hero']['dexterity'],
            $data['Hero']['stamina'],
            $data['Hero']['intelligence'],
            $data['Hero']['wisdom'],
            TypeDef::HERO
        );
        $mob = new Mob(
            $data['Mob']['strength'],
            $data['Mob']['dexterity'],
            $data['Mob']['stamina'],
            $data['Mob']['intelligence'],
            $data['Mob']['wisdom']
        );

        /**
         * This is earth in this example since the hero lives on earth and this is how we determin daytime/nighttime
         * relative to earth
         * kinda using some hardcoded mappings to map Earth as being the relative planet
         * for now we ignore inputs on relative planet regarding stolen/saved since stealing earth not something that can happen
         */
        $relativePlanet = new Earth();
        $relativePlanet->setObjectType($data['Earth']['objectType']);
        $relativePlanet->setStolen(false);
        $relativePlanet->setSaved(true);
        $relativePlanet->setTimeOfDay($data['Earth']['timeOfDay']);

        /**
         * If there were more than these 2 planets to be saved we would initialize these
         * (in case we decide on continuing creating objects from input) in a more dynamic manner
         * but in this small case we just hardcode the initialization
         */
        $hostages = [];
        $moon = new Moon();
        $moon->setObjectType($data['Moon']['objectType']);
        $moon->setStolen($data['Moon']['stolen']);
        $moon->setSaved($data['Moon']['saved']);
        $moon->setRelativePlanet($relativePlanet);

        $sun = new Sun();
        $sun->setObjectType($data['Sun']['objectType']);
        $sun->setStolen($data['Sun']['stolen']);
        $sun->setSaved($data['Sun']['saved']);
        $sun->setRelativePlanet($relativePlanet);


        /**
         * Normally i'd put this business logic in a service somewhere and inject entitymanager in it,
         * but for now i'll just put it here
         */

        $q = new \SplStack();
        $q->push($moon);
        $q->push($sun);
        $q->rewind();
        $output = [];
        while($q->valid()){

            $winner = $hero->fight($mob, $relativePlanet, $q->current());
            $log = new \App\Entity\Log();
            $log->setClass((string)$q->current());
            if($winner) {
                $output[] = 'Hero wom! '.(string)$q->current().' was saved';
                $log->setAction('Saved');
                $log->setValue(json_encode(['stolen' => false]));
            } else {
                $output[] = (string)$q->current().' is stolen';
                $log->setAction('Stolen');
                $log->setValue(json_encode(['stolen' => true]));
            }
            $em->persist($log);
            $q->next();

        }
        $em->flush();
        Http::response(var_export($output), 200);
}, 'post');
Router::run('/story/public');