<?php

require_once './stripe-php/init.php';

use Stripe\StripeClient;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use UnexpectedValueException;

// Configure the Stripe client with your secret key
$stripe = new StripeClient('sk_test_...');

// Stripe CLI webhook secret for verifying signatures
$endpoint_secret = 'whsec_37a724673f866b4758f9409dd51eb30ca1b8bad5757fe0fb4c6447197d6c1803';

// Database connection details
$db_host = 'php56-db';
$db_user = 'Anwar123';
$db_password = 'Anwar123';
$db_name = 'Anwar123';

// Create a database connection
$db = mysql_connect($db_host, $db_user, $db_password);

if (!$db) {
    error_log('Database connection failed: ' . mysql_error());
    http_response_code(500);
    exit();
}

// Select the database
if (!mysql_select_db($db_name, $db)) {
    error_log('Database selection failed: ' . mysql_error());
    http_response_code(500);
    exit();
}

// Define the mapping of amount_total (in cents) to gold values
$amountToGoldMapping = [
    500 => 50000,         // 5 USD => 50,000 gold
    1000 => 150000,       // 10 USD => 150,000 gold
    2000 => 500000,       // 20 USD => 500,000 gold
    5000 => 1500000,      // 50 USD => 1,500,000 gold
    10000 => 3500000,     // 100 USD => 3,500,000 gold
    20000 => 8000000      // 200 USD => 8,000,000 gold
];

// Read the incoming request payload
$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    // Verify the event by constructing it using the Stripe webhook secret
    $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
} catch (UnexpectedValueException $e) {
    // Invalid payload
    error_log('Invalid payload: ' . $e->getMessage());
    http_response_code(400);
    exit();
} catch (SignatureVerificationException $e) {
    // Invalid signature
    error_log('Invalid signature: ' . $e->getMessage());
    http_response_code(400);
    exit();
}

// Handle the event
switch ($event->type) {
    case 'checkout.session.completed':
        $session = $event->data->object;
        $playerId = mysql_real_escape_string($session->client_reference_id);
        $amountTotal = $session->amount_total;

        // Check if the amount_total corresponds to any defined gold value
        if (array_key_exists($amountTotal, $amountToGoldMapping)) {
            $goldToAdd = $amountToGoldMapping[$amountTotal];

            // Fetch the current gold of the player
            $query = "SELECT gold_num FROM p_players WHERE id = '$playerId'";
            $result = mysql_query($query);

            if ($result && mysql_num_rows($result) > 0) {
                $row = mysql_fetch_assoc($result);
                $currentGold = $row['gold_num'];

                // Add the calculated gold to the player's account
                $newGold = $currentGold + $goldToAdd;
                $updateQuery = "UPDATE p_players SET gold_num = $newGold WHERE id = '$playerId'";
                mysql_query($updateQuery);

                // Log the successful update
                $logData = sprintf(
                    "Player ID: %s\nAmount Total: %d\nGold Added: %d\nNew Gold: %d\n\n",
                    $playerId, $amountTotal, $goldToAdd, $newGold
                );
                file_put_contents('XX_52E1GseYAa.txt', $logData, FILE_APPEND | LOCK_EX);
            } else {
                error_log('Player not found: ' . $playerId);
            }
        } else {
            error_log('Amount total does not match any known value: ' . $amountTotal);
        }

        break;

    default:
        // Log unknown event types
        error_log('Received unknown event type: ' . $event->type);
        break;
}

// Send a 200 response to acknowledge receipt of the event
http_response_code(200);

// Close the database connection
mysql_close($db);

