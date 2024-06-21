<?php
$pidFile = __DIR__ . '/tmp/php_server.pid'; // Use current directory for PID file

// Check if PID file exists
if (!file_exists($pidFile)) {
    die('No server running. <br>');
}

// Get the PID and kill the process
$pid = file_get_contents($pidFile);
if ($pid) {
    if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
        // Windows
        exec("taskkill /F /PID $pid");
    } else {
        // Linux/Mac
        exec("kill $pid");
    }
    // Remove the PID file
    unlink($pidFile);
    echo 'Server stopped. <br>';
} else {
    die('Unable to read PID. <br>');
}

?>