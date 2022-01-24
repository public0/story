<?php


namespace App\Entity\Celestials\Interfaces;


interface RelativePlanetInterface
{
    public function getTimeOfDay();
    public function setTimeOfDay($timeOfDay);
}