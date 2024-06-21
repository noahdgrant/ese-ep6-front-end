<?php
$pidFile = __DIR__ . '/tmp/php_server.pid'; // Use current directory for PID file
ob_implicit_flush(true);

// Allow the script to hang around waiting for connections.
set_time_limit(0);

// Check if server is already running
if (file_exists($pidFile)) {
    die('Server is already running. <br>');
}

// Determine the correct command to start the server
if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
    // Windows
    $command = 'start /B C:\xampp\php\php.exe -f server.php';
} else {
    // Linux/Mac
    $command = 'php -f server.php > /dev/null 2>&1 & echo $!';
}
// Execute the command and save the PID
echo 'Server started. <br>';
shell_exec($command);
?>