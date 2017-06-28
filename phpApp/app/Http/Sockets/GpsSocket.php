<?php namespace App\Http\Sockets;

use App\Models\StaffLocations\StaffLocations;
use App\Models\Users\User;
use Orchid\Socket\BaseSocketListener;
use Ratchet\ConnectionInterface;

/**
 * Class GpsSocket
 * @package App\Http\Sockets
 * @todo add checking permission who can view staff
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

        if(User::query()->where('api_token', '=', $token)->first() != null){
            $this->clients->attach($conn);
        }else{
            $conn->send('You are not authentificated.');
            $conn->close();
        }

    }

    public function onMessage(ConnectionInterface $from, $msg) {
        if(!is_numeric($msg)){
            $from->send('Send please numeric id');
        } else{
            $staffId = intval($msg);
            $location = StaffLocations::query()->where('user_id', '=', $staffId)->orderBy('id', 'DESC')->first();
            if($location != null){
                $from->send(json_encode(['lat' => $location->lat, 'lon' => $location->lon]));
            }else{
                $from->send('Location not found.');
            }
        }

    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

}