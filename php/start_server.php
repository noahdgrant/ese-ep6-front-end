<?php
$pidFile = __DIR__ . '/tmp/php_server.pid'; // Use current directory for PID file

// Check if server is already running
if (file_exists($pidFile)) {
    die('Server is already running.');
}

// Determine the correct command to start the server
if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
    // Windows
    $command = 'start /B php -f server.php';
} else {
    // Linux/Mac
    $command = 'php -f server.php > /dev/null 2>&1 & echo $!';
}
// Execute the command and save the PID
$pid = shell_exec($command);
file_put_contents($pidFile, $pid);

echo 'Server started.';
?>