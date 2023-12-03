<?php
require_once __DIR__ . '/bootstrap.php';

use Curiousfin\RabbitmqDemo\ConnectionFactory;

$connection = (new ConnectionFactory())->make();
$connection->pconnect();
$channel = new AMQPChannel($connection);

$exchange = new AMQPExchange($channel);
$exchange->setName('ExchangeFanout');
$exchange->setType(AMQP_EX_TYPE_FANOUT);
$exchange->declareExchange();

$queue = new AMQPQueue($channel);
$queue->setName('QueueFanout1');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeFanout');

$queue = new AMQPQueue($channel);
$queue->setName('QueueFanout2');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeFanout');

$queue = new AMQPQueue($channel);
$queue->setName('QueueFanout3');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeFanout');

$message = ['message' => 'Message from exchange fanout will send to all queues'];
$exchange->publish(json_encode($message), 'ExchangeFanout');