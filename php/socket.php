
<?php
error_reporting(E_ALL);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting
 * as it comes in. */
ob_implicit_flush(true);

$address  = '192.168.2.187';    // Localhost IP
$port = 12345;              // Port to listen on


// Create a TCP/IP socket
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    die("socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n");
}

// Bind the socket to the address and port
if (socket_bind($sock, $address, $port) === false) {
    die("socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n");
}

// Listen for incoming connections
if (socket_listen($sock, 5) === false) {
    socket_close($sock);
    die("socket_listen() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n");
}

do {
    // Attempt to connect to client
    if (($msgsock = socket_accept($sock)) === false) {
        echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
        break;
    }

    do {
        if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
            echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($msgsock)) . "\n";
            break 2;
        }
        if (!$buf = trim($buf)) {
            continue;
        }
        if ($buf == 'quit') {
            break;
        }
        if ($buf == 'shutdown') {
            socket_close($msgsock);
            break 2;
        }
        $talkback = "PHP: You said '$buf'.\n";
        socket_write($msgsock, $talkback, strlen($talkback));

        echo "$buf\n";
        break 2;

    } while (true);
    socket_close($msgsock);
} while (true);

socket_close($sock);
?>
