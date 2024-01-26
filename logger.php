<?php
function logError($message, $page, $issue) {
    $logFile = 'logs/' . date('Y-m-d') . '-error-log.txt';
    $logMessage = "[" . date('Y-m-d H:i:s') . "] Page: " . $page . " - Issue: [" . $issue . "] - " . $message . "\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}
?>