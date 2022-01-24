<?php

namespace App\Entity\Celestials;
use App\Entity\Celestials\Interfaces\PlanetMovements;
use App\Entity\TypeDef;

class Sun extends CelestialObject implements PlanetMovements {

    public function __construct() {
        $this->setObjectType('diurnal');
        $this->setSaved(false);
        $this->setStolen(true);
    }

    public function rise(): bool {
        if($this->getRelativePlanet() && $this->getRelativePlanet()->getTimeOfDay() == TypeDef::DAY) {
            return true;
        } else {
            return false;
        }
    }
    public function set() {
        if($this->getRelativePlanet() && $this->getRelativePlanet()->getTimeOfDay() == TypeDef::NIGHT) {
            return true;
        } else {
            return false;
        }
    }

}