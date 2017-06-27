<?php namespace App\Http\Sockets;

use Orchid\Socket\BaseSocketListener;
use Ratchet\ConnectionInterface;

class GpsSocket extends BaseSocketListener {

 protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        $token = $from->WebSocket->request->getQuery()->get('token');
        $from->send($token);

    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

}