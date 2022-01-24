<?php
namespace App\Entity\Celestials;

use App\Entity\FormGenerator;

abstract class CelestialObject {
    private $objectType;
    private $stolen = false;
    private $saved = true;
    private $relativePlanet = NULL;
    use FormGenerator;

    /**
     * @return mixed
     */
    final public function getRelativePlanet() : CelestialObject
    {
        return $this->relativePlanet;
    }

    /**
     * @param mixed $relativePlanet
     */
    public function setRelativePlanet($relativePlanet)
    {
        $this->relativePlanet = $relativePlanet;
    }

    /**
     * @return mixed
     */
    final public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * @param mixed $objectType
     */
    final public function setObjectType($objectType)
    {
        $this->objectType = $objectType;
    }

    /**
     * @return mixed
     */
    final public function getStolen()
    {
        return $this->stolen;
    }

    /**
     * @param mixed $stolen
     */
    public function setStolen($stolen)
    {
        $this->stolen = $stolen;
        $this->saved = !$stolen;
    }

    /**
     * @return mixed
     */
    final public function getSaved()
    {
        return $this->saved;
    }

    /**
     * @param mixed $saved
     */
    public function setSaved($saved)
    {
        $this->saved = $saved;
        $this->stolen = !$saved;
    }

    public function __toString()
    {
        $class = explode('\\', get_class($this));
        return end($class);
    }

}