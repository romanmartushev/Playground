<?php
/**
 * Send post request with 'shortcode' key to parse the shortcode into a json array
 */
header('Content-Type: application/json');
require_once __DIR__ . '/ShortCodeParser.php';
$return = [];
$_POST = json_decode(file_get_contents('php://input'), true);
$shortCode = isset($_POST['shortcode']) ? $_POST['shortcode'] : null;
if($shortCode) {
    $return = ShortCodeParser::formatOutput($shortCode);
} else {
    $return['error'] = "Missing shortcode";
}

print json_encode($return);