<?php

use Doctrine\ORM\EntityManager;

require_once __DIR__.'/bootstrap/app.php';

/** @var $entityManager */
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
