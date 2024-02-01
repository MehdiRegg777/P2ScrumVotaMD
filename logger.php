<?php

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  

function logError($message, $page, $issue) {
    $logFile = 'logs/' . date('Y-m-d') . '-error-log.txt';
    $logMessage = "[" . date('Y-m-d H:i:s') . "] - ". getIPAddress() ." - Page: " . $page . " - Issue: [" . $issue . "] - " . $message . "\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}
?>