<?php
require_once __DIR__ . '/bootstrap.php';

use Curiousfin\RabbitmqDemo\ConnectionFactory;

$connection = (new ConnectionFactory())->make();
$connection->pconnect();
$channel = new AMQPChannel($connection);

$exchange = new AMQPExchange($channel);
$exchange->setName('ExchangeHeaders');
$exchange->setType(AMQP_EX_TYPE_HEADERS);
$exchange->declareExchange();

$queue = new AMQPQueue($channel);
$queue->setName('QueueHeaders1');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeHeaders', null, ['name' => 'color']);

$queue = new AMQPQueue($channel);
$queue->setName('QueueHeaders2');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('ExchangeHeaders', null, ['name' => 'size']);

$message = ['message' => 'Message from exchange headers will send to queues with header key color'];
$exchange->publish(json_encode($message),  null, AMQP_NOPARAM, ['headers' => ['name' => 'color']]);

$message = ['message' => 'Message from exchange headers will send to queues with header key size'];
$exchange->publish(json_encode($message),  null, AMQP_NOPARAM, ['headers' => ['name' => 'size']]);

