<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$parser = new Hoa\Console\Parser();
$parser->parse(Hoa\Router\Cli::getURI());

$options = new Hoa\Console\GetOption(
    array(
        array('colonnes',  Hoa\Console\GetOption::REQUIRED_ARGUMENT, 'y'),
        array('lines',  Hoa\Console\GetOption::REQUIRED_ARGUMENT, 'x'),
        array('random',   Hoa\Console\GetOption::OPTIONAL_ARGUMENT, 'r'),
        array('help',   Hoa\Console\GetOption::OPTIONAL_ARGUMENT, 'h'),
    ),
    $parser
);

$gof = new \GameOfLife\Conway();

while (false !== $shortName = $options->getOption($value)) {
    switch($shortName) {
        case 'r':
            $gof->initRandomWorld();
            break;
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
