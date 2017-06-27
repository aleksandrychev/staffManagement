<?php

/*
 *  Routes for WebSocket
 *
 * Add route (Symfony Routing Component)
 * $socket->route('/myclass', new MyClass, ['*']);
 */

$socket->route('/gps', new \App\Http\Sockets\GpsSocket(), ['*']);