<?php
declare(strict_types=1);

namespace Curiousfin\RabbitmqDemo;

use AMQPConnection;

class ConnectionFactory
{
    public function make(): AMQPConnection
    {
        return new AMQPConnection([
            'host' => 'rabbitmq',
            'port' => 5672,
            'vhost' => '/',
            'login' => 'admin',
            'password' => 'admin',
        ]);
    }
}