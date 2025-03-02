<?php 
function customErrorHandler($errno, $errstr, $errfile, $errline) { 
$logMessage = "[" . date('Y-m-d H:i:s') . "] Error: $errstr in $errfile on line $errline\n"; 
error_log($logMessage, 3, 'error_log.log'); 
echo "An error occurred. Please try again later."; 
} 
set_error_handler('customErrorHandler'); 
?> 