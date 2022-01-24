<?php
require_once __DIR__.'/vendor/autoload.php';

use App\Entity\CelestialObject;
$a = new CelestialObject();
$a->setObjectType('stolen');
echo $a->getObjectType();