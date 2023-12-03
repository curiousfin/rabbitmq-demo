<?php
require_once __DIR__ . '/bootstrap.php';

use Curiousfin\RabbitmqDemo\ConnectionFactory;

$connection = (new ConnectionFactory())->make();
$connection->pconnect();
$channel = new AMQPChannel($connection);

$exchange = new AMQPExchange($channel);
$exchange->setName('ExchangeDirect');
$exchange->setType(AMQP_EX_TYPE_DIRECT);
$exchange->declareExchange();

$queue = new AMQPQueue($channel);
$queue->setName('QueueDirect1');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeDirect', 'adidas');

$queue = new AMQPQueue($channel);
$queue->setName('QueueDirect2');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeDirect', 'nike');

$message = ['message' => 'Message from exchange direct will send to queues with routing key adidas'];
$exchange->publish(json_encode($message), 'adidas');

$message = ['message' => 'Message from exchange direct will send to queues with routing key nike'];
$exchange->publish(json_encode($message), 'nike');