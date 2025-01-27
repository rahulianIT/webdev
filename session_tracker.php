<?php
session_start();

function logSessionActivity($activity) {
    // Assuming a simple log file for demonstration
    $logFile = 'session_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    $userId = $_SESSION['user_id'] ?? 'Guest'; // Get user ID or set as Guest
    $logEntry = "[$timestamp] User: $userId - Activity: $activity\n";
    
    file_put_contents($logFile, $logEntry, FILE_APPEND);
}
?>
