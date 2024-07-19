<?php
/* if using xampp
* make sure to add the line: extension=php_sockets.dll
* to C:\xampp\php\php.ini
*/

$host = "192.168.1.201";
$port = 12345;
$pidFile = __DIR__ . "/tmp/php_server.pid"; // Use current directory for PID file

// Turn on implicit output flushing so we see what we're getting as it comes in.
ob_implicit_flush(true);

//tern off error reporting
error_reporting(0);
file_put_contents($pidFile,  getmypid());

// Allow the script to hang around waiting for connections.
set_time_limit(0);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die(json_encode(array("success" => "false", "message" => "Error: could not create socket.")));

function shutdown() {
    global $socket;
    if ($socket) {
        socket_close($socket);
    }
}
register_shutdown_function("shutdown");

socket_bind($socket, $host, $port) or die(json_encode(array("success" => "false", "message" => "Error: Couldnt bind socket.")));

socket_listen($socket, 5) or die(json_encode(array("success" => "false", "message" => "Error: Cannot listen to socket.")));

do {
    $client_socket = socket_accept($socket);
    if ($client_socket === false) {
        //echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
        break;
    }
    $input = socket_read($client_socket, 1024);
    if ($input === false) {
        //echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($client_socket)) . "\n";
        break;
    }

    $input = trim($input);
    $filePath = "../json/card_read.json";
    $file = fopen($filePath, "c+");
    if (flock($file, LOCK_EX)) { // Exclusive lock for writing
        ftruncate($file, 0); // Truncate the file
        fwrite($file, json_encode($input, JSON_PRETTY_PRINT));
        fflush($file); // Ensure all data is written to disk
        flock($file, LOCK_UN); // Release the lock
    } else {
        throw new Exception("Could not lock file for writing");
    }
    fclose($file);


    $response = "Hello, client. You said: $input\n";
    socket_write($client_socket, $response, strlen($response));
    socket_close($client_socket);
} while (true);

socket_close($socket);

?>