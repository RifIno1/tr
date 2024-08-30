<?php

// Connect to the database
$connection = mysql_connect("php56-db", "Anwar123", "Anwar123");
if (!$connection) {
    die("Connection failed: " . mysql_error());
}

// Select the database
$db_selected = mysql_select_db("Anwar123", $connection);
if (!$db_selected) {
    die("Can't use tatar: " . mysql_error());
}

// Get input parameters and escape them
$playerId = intval($_GET['playerId']);
$troopsCropConsume = intval($_GET['troopsCropConsume']);
$fromVillageId = intval($_GET['fromVillageId']);
$toVillageId = intval($_GET['toVillageId']);

// Function to get player_id from a village
function getPlayerId($connection, $villageId) {
    $query = "SELECT player_id FROM p_villages WHERE id = " . intval($villageId);
    $result = mysql_query($query, $connection);
    if (!$result) {
        die("Error in query: " . mysql_error());
    }
    $row = mysql_fetch_assoc($result);
    return $row['player_id'];
}

// Query to get player_id for fromVillageId
$fromVillagePlayerId = getPlayerId($connection, $fromVillageId);

// Query to get player_id for toVillageId
$toVillagePlayerId = getPlayerId($connection, $toVillageId);


echo $fromVillagePlayerId;
echo "<br>";
echo $toVillagePlayerId;
echo "<br>";
echo $playerId;
echo "<br>";

$result1 = false;
$result2 = false;

if ($playerId == $fromVillagePlayerId || $playerId == $toVillagePlayerId) {
   
    echo "Player is authorized to update crop consumption!";

    // Query to update crop consumption fromVillageId
    $query1 = "UPDATE p_villages v SET v.crop_consumption = v.crop_consumption - " . $troopsCropConsume . " WHERE v.id = " . $fromVillageId;
    $result1 = mysql_query($query1, $connection);

    if (!$result1) {
        die("Error in query: " . mysql_error());
    }

    // Query to update crop consumption toVillageId
    $query2 = "UPDATE p_villages v SET v.crop_consumption = v.crop_consumption + " . $troopsCropConsume . " WHERE v.id = " . $toVillageId;
    $result2 = mysql_query($query2, $connection);

    if (!$result2) {
        die("Error in query: " . mysql_error());
    }
}

if ($result1 && $result2) {
    header("Location: village1.php?cropConsumptionUpdated=true");
    exit();
}else{
    header("Location: village1.php?cropConsumptionUpdated=false");
}

// Close the connection
mysql_close($connection);
?>
