<?php

namespace App\Entity\Celestials;
use App\Entity\Celestials\Interfaces\PlanetMovements;
use App\Entity\TypeDef;

class Moon extends CelestialObject implements PlanetMovements{

    public function __construct() {
        $this->setObjectType('nocturnal');
    }

    public function rise() {
        if($this->getRelativePlanet() && $this->getRelativePlanet()->getTimeOfDay() == TypeDef::NIGHT) {
            return true;
        } else {
            return false;
        }
    }
    public function set() {
        if($this->getRelativePlanet() && $this->getRelativePlanet()->getTimeOfDay() == TypeDef::DAY) {
            return true;
        } else {
            return false;
        }
    }
}