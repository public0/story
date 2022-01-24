<?php

namespace App\Entity\Celestials;
use App\Entity\Celestials\Interfaces\RelativePlanetInterface;
use App\Entity\Celestials\Traits\RelativePlanet;

class Earth extends CelestialObject implements RelativePlanetInterface {
    use RelativePlanet;

    public function __construct() {
        $this->setObjectType('non-binary');
    }

    /**
     * @return mixed
     */
    public function getTimeOfDay()
    {
        return $this->timeOfDay;
    }

    /**
     * @param $timeOfDay
     */
    public function setTimeOfDay($timeOfDay)
    {
        $this->timeOfDay = $timeOfDay;
    }


}