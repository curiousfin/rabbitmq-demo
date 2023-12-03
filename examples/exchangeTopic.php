<?php
require_once __DIR__ . '/bootstrap.php';

use Curiousfin\RabbitmqDemo\ConnectionFactory;

$connection = (new ConnectionFactory())->make();
$connection->pconnect();
$channel = new AMQPChannel($connection);

$exchange = new AMQPExchange($channel);
$exchange->setName('ExchangeTopic');
$exchange->setType(AMQP_EX_TYPE_TOPIC);
$exchange->declareExchange();

$queue = new AMQPQueue($channel);
$queue->setName('QueueTopic1');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeTopic', 'color.*');

$queue = new AMQPQueue($channel);
$queue->setName('QueueTopic2');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeTopic', 'size.*');

$message = ['message' => 'Red message from exchange topic will send to queues with routing key color.*'];
$exchange->publish(json_encode($message), 'color.red');
$exchange->publish(json_encode($message), 'color.green');

$message = ['message' => 'Big size from exchange topic will send to queues with routing key size.*'];
$exchange->publish(json_encode($message), 'size.medium');
$exchange->publish(json_encode($message), 'size.big');
