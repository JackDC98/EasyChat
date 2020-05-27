<?php

require_once 'vendor/autoload.php';

use PHPSocketIO\SocketIO;
use Workerman\Worker;

$server = new SocketIO(3000);

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    system('cls');
} else {
    system('clear');
}

echo "Vue Websocket Chat server started. Use Ctrl+C to shut the server down.\n============================================================\n\n";

register_shutdown_function(function() {
    echo "\nExiting...";
});

function consoleLog($message) {
    $timestamp = date('Y-m-d h:i:s');
    echo "[$timestamp]: $message\n";
}

$server->on('connection', function($socket) {

    global $users;
    global $messages;

    if (is_null($users)) $users = [];
    if (is_null($messages)) $messages = [];
    
    $socket->emit('sync', json_encode($messages));
    $socket->emit('getusers', json_encode($users));

    $socket->on('sendmessage', function($data) use($socket) {
        global $messages;

        $message = json_decode($data);
        array_push($messages, $message);

        consoleLog("Message from $socket->username: $message->content");

        $socket->emit('sync', json_encode($messages));
        $socket->broadcast->emit('sync', json_encode($messages));
    });

    $socket->on('disconnect', function() use($socket) {
        global $users;

        unset($users[array_search($socket->username, $users)]);
        consoleLog("$socket->username disconnected.");

        $socket->emit('getusers', json_encode($users));
        $socket->broadcast->emit('getusers', json_encode($users));
    });

    $socket->on('unsetusername', function() use($socket) {
        global $users;

        unset($users[array_search($socket->username, $users)]);
        $socket->emit('getusers', json_encode($users));
        $socket->broadcast->emit('getusers', json_encode($users));
    });

    $socket->on('setusername', function($username) use($socket) {
        global $users;
        
        $socket->username = $username;
        if(!in_array($username, $users)) {
            array_push($users, $username);
        }

        consoleLog("$socket->username has connected.");
        $socket->emit('getusers', json_encode($users));
        $socket->broadcast->emit('getusers', json_encode($users));
    });

});

Worker::runAll();
