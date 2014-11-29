<?php

// Add the Olix Installer test paths.
$loader = require __DIR__ . '/../src/bootstrap.php';
$loader->add('OlixInstaller', __DIR__);

// Allow use of the Composer\Test namespace.
$path = $loader->findFile('Composer\\Composer');
$loader->add('Composer\Test', dirname(dirname(dirname($path))) . '/tests');
