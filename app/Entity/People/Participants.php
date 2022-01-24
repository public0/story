<?php


namespace App\Entity\People;


use App\Entity\Celestials\CelestialObject;
use App\Entity\Celestials\Interfaces\RelativePlanetInterface;
use App\Entity\TypeDef;

abstract class Participants
{
    private   $type;
    protected $strength;
    protected $dexterity;
    protected $stamina;
    protected $intelligence;
    protected $wisdom;

    /**
     * Hero constructor.
     * @param int $strength
     * @param int $dexterity
     * @param int $stamina
     * @param int $intelligence
     * @param int $wisdom
     * @param string $type
     */
    public function __construct(
        int $strength = NULL,
        int $dexterity = NULL,
        int $stamina = NULL,
        int $intelligence = NULL,
        int $wisdom = NULL,
        string $type = TypeDef::MOB
    )
    {
        $this->strength = isset($strength)?$strength:rand(50, 110);
        $this->dexterity = isset($dexterity)?$dexterity:rand(50, 110);
        $this->stamina = isset($stamina)?$stamina:rand(50, 110);
        $this->intelligence = isset($intelligence)?$intelligence:rand(50, 110);
        $this->wisdom = isset($wisdom)?$wisdom:rand(50, 110);
        $this->setType($type);

    }

    /**
     * Decided to add fight functionality to Participants class instead of making separate Battle class
     * with 2 Participants as dependency
     * Method return winner or false if battle not taking place
     * @param Participants $enemy
     * @param RelativePlanetInterface $relativePlanet
     * @param CelestialObject $hostage
     * @return bool
     */
    public function fight(Participants $enemy, RelativePlanetInterface $relativePlanet, CelestialObject $hostage)
    {
        $attackerScore = 0;
        $defenderScore = 0;
        if($hostage->getStolen()) {
            foreach ($this as $prop => $value) {
                if ($value >= $enemy->{'get' . ucfirst($prop)}()) {
                    $attackerScore++;
                } else {
                    $defenderScore++;
                }
            }
            if($attackerScore < $defenderScore)
                return false;
        } else return false;
        return true;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     */
    public function setStrength(int $strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return int
     */
    public function getDexterity(): int
    {
        return $this->dexterity;
    }

    /**
     * @param int $dexterity
     */
    public function setDexterity(int $dexterity)
    {
        $this->dexterity = $dexterity;
    }

    /**
     * @return int
     */
    public function getStamina(): int
    {
        return $this->stamina;
    }

    /**
     * @param int $stamina
     */
    public function setStamina(int $stamina)
    {
        $this->stamina = $stamina;
    }

    /**
     * @return int
     */
    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    /**
     * @param int $intelligence
     */
    public function setIntelligence(int $intelligence)
    {
        $this->intelligence = $intelligence;
    }

    /**
     * @return int
     */
    public function getWisdom(): int
    {
        return $this->wisdom;
    }

    /**
     * @param int $wisdom
     */
    public function setWisdom(int $wisdom)
    {
        $this->wisdom = $wisdom;
    }

    public function __toString()
    {
        $class = explode('\\', get_class($this));
        return end($class);
    }

}