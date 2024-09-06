<?php
// Sample input string
$input = "1 312000000 312000000 8000 1225000 25,2 312000000 312000000 8000 1225000 50,3 312000000 312000000 8000 1225000 50,4 780000000 780000000 8000 18375000 350";

// Split the input string by commas to get each section
$sections = explode(',', $input);

// Variable to store the overall result (true if all sections meet the conditions)
$allTrue = true;

// Loop through each section and check the conditions
foreach ($sections as $section) {
    if (!checkConditions($section)) {
        $allTrue = false;
        return; 
    }
}


/* LOGIC */



// Function to check the conditions for each section
function checkConditions($section) {
    $numbers = explode(' ', $section);
    return ($numbers[0] == 4 && (float)$numbers[5] >= 325) || ($numbers[0] != 4 && (float)$numbers[5] >= 25);
}
?>
