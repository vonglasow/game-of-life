<?php
$runner->setBootstrapFile(__DIR__ . '/.bootstrap.atoum.php')
    ->addExtension(new Atoum\PraspelExtension\Manifest())
;

$coverageField = new atoum\report\fields\runner\coverage\html('Game Of Life', __DIR__ . '/tests/coverage/');
$coverageField->setRootUrl('http://127.0.0.1');

$report = $script->addDefaultReport();
$report->addField($coverageField)
       ->addField(new atoum\report\fields\runner\result\logo());
