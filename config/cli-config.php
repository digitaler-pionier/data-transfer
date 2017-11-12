<?php
declare(strict_types=1);

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$em = include 'em.php';

return ConsoleRunner::createHelperSet($em);
