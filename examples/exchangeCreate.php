<?php
require_once __DIR__ . '/bootstrap.php';

use Curiousfin\RabbitmqDemo\ConnectionFactory;

$connection = (new ConnectionFactory())->make();
$connection->pconnect();
$channel = new AMQPChannel($connection);

$exchange = new AMQPExchange($channel);
$exchange->setName('testExchange');
$exchange->declareExchange();