<?php namespace App\Http\Sockets;

use App\Models\Users\User;
use Orchid\Socket\BaseSocketListener;
use Ratchet\ConnectionInterface;

/**
 * Class GpsSocket
 * @package App\Http\Sockets
 * @todo add checking permission who can view courier
 */
class GpsSocket extends BaseSocketListener {

 protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        /**
         * @todo move auth checking to some service
         */
        $token = $conn->WebSocket->request->getQuery()->get('token');
        $user = User::query()->where('api_token', '=', $token)->find();
        if($user){
            $this->clients->attach($conn);
        }else{
            $conn->close();
        }

    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $from->send('hi');
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

}