<?php


namespace App\Entity;


use App\Entity\People\Participants;

class Fight
{
    private $player1;
    private $player2;
    /**
     * Fight constructor.
     * @param Participants $player1
     * @param Participants $player2
     */
    public function __construct(Participants $player1, Participants $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        self::fight();
    }

    private function fight() {

        $participant1 = explode('\\', get_class($this->player1));
        $participant1Name = end($participant1);

        $participant2 = explode('\\', get_class($this->player2));
        $participant2Name = end($participant2);

//        dump($this->player1->getStrength());
        foreach ($this->player1 as $prop=>$value) {
            dump($prop);
        }
        dd($this->player1);
    }
}