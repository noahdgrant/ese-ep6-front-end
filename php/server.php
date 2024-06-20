<?php
$host = '127.0.0.1';
$port = 12345;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    die("socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n");
}

function shutdown() {
    global $socket;
    if ($socket) {
        socket_close($socket);
        echo "Socket closed.\n";
    }
}
register_shutdown_function('shutdown');

$result = socket_bind($socket, $host, $port);
if ($result === false) {
    die("socket_bind() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n");
}

$result = socket_listen($socket, 5);
if ($result === false) {
    die("socket_listen() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n");
}

echo "Server listening on $host:$port\n";

do {
    $client_socket = socket_accept($socket);
    if ($client_socket === false) {
        echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
        break;
    }

    $input = socket_read($client_socket, 1024);
    if ($input === false) {
        echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($client_socket)) . "\n";
        break;
    }

    $input = trim($input);
    echo "Received message: $input\n";

    $response = "Hello, client. You said: $input\n";
    socket_write($client_socket, $response, strlen($response));

    socket_close($client_socket);
} while (true);

socket_close($socket);
?>
