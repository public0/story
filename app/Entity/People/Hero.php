<?php
namespace App\Entity\People;

use App\Entity\FormGenerator;

class Hero extends Participants
{
    private static $instance = null;
    use FormGenerator;

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Hero();
        }
        return self::$instance;
    }

}