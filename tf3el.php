<?php
// Sample input string
$input = "1 312000000 312000000 8000 1225000 50,2 312000000 312000000 8000 1225000 50,3 312000000 312000000 8000 1225000 50,4 780000000 780000000 8000 18375000 50";

// Split the input string by commas to get each section
$sections = explode(',', $input);

// Function to check the conditions for each section
function checkConditions($section) {
    // Split the section by spaces to extract numbers
    $numbers = explode(' ', $section);
    
    // The last number in the section
    $lastNumber = (float)end($numbers);
    
    $last = (float)end($numbers);
    echo $last;
    echo '<br>';

    return ($last >= 25);
}

// Variable to store the overall result (true if all sections meet the conditions)
$allTrue = true;

// Loop through each section and check the conditions
foreach ($sections as $section) {
    if (!checkConditions($section)) {
        $allTrue = false;
        break; // No need to continue if one section fails
    }
}

// Output the result
if ($allTrue) {
    echo "<br>True";
} else {
    echo "<br>False";
}
?>
