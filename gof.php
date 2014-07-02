<?php

require_once 'source/Gof.php';

$parser = new Hoa\Console\Parser();
$parser->parse(Hoa\Router\Cli::getURI());

$options = new Hoa\Console\GetOption(
    array(
        array('colonnes',  Hoa\Console\GetOption::REQUIRED_ARGUMENT, 'y'),
        array('lines',  Hoa\Console\GetOption::REQUIRED_ARGUMENT, 'x'),
        array('help',   Hoa\Console\GetOption::OPTIONAL_ARGUMENT, 'h'),
    ),
    $parser
);

$gof = new GameOfLife();

while (false !== $shortName = $options->getOption($value)) {
    switch($shortName) {
        case 'x':
            $gof->setX($value);
            break;
        case 'y':
            $gof->setY($value);
            break;
        case 'h':
            $this->help();
            break;
    }
}

$gof->run();
