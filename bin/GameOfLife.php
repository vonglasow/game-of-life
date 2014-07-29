<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$parser = new Hoa\Console\Parser();
$parser->parse(Hoa\Router\Cli::getURI());

$options = new Hoa\Console\GetOption(
    array(
        array('colonnes',  Hoa\Console\GetOption::REQUIRED_ARGUMENT, 'y'),
        array('lines',  Hoa\Console\GetOption::REQUIRED_ARGUMENT, 'x'),
        array('random',   Hoa\Console\GetOption::OPTIONAL_ARGUMENT, 'r'),
        array('glider-gun', Hoa\Console\GetOption::OPTIONAL_ARGUMENT, 'g'),
        array('help',   Hoa\Console\GetOption::OPTIONAL_ARGUMENT, 'h'),
    ),
    $parser
);

$gof = new \GameOfLife\Conway();
$universe = new \GameOfLife\Universe();

while (false !== $shortName = $options->getOption($value)) {
    switch($shortName) {
        case 'r':
            $universe->setWorldStatus(\GameOfLife\Universe::RANDOM);
            break;
        case 'g':
            $universe->setWorldStatus(\GameOfLife\Universe::GLIDER_GUN);
            break;
        case 'x':
            $universe->setLength($value);
            break;
        case 'y':
            $universe->setWidth($value);
            break;
        case 'h':
            $this->help();
            break;
    }
}

$universe->initWorld();

$gof->setUniverse($universe);
$gof->run();
