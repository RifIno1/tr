<?php

// Input string
$input = "1 2 0,4 0 0,1 0 0,3 2 0,2 2 0,2 0 0,3 0 0,4 0 0,4 2 0,3 0 0,3 0 0,4 0 0,4 0 0,1 0 0,4 0 0,2 0 0,1 0 0,2 0 0,0 0 0,0 0 0,15 12 0,39 5 0,38 5 0,40 10 0,40 0 0,40 0 0,0 0 0,0 0 0,40 0 0,40 0 0,0 0 0,0 0 0,40 0 0,0 0 0,0 0 0,0 0 0,0 0 0,0 0 0,0 0 0,0 0 0";

// Split the input string by commas into an array
$parts = explode(',', $input);

// Check if there are enough parts after splitting
if (isset($parts[23])) {
    // Get the segment after the 24th comma (25th part)
    $segment = $parts[23];
    
    // Check if the segment starts with "40 0" or "0 0"
    if (strpos($segment, '40 0') === 0 || strpos($segment, '0 0') === 0) {
        // Iterate through the array and change "40 0" to "0 0" if condition met
        foreach ($parts as &$part) {
            if (strpos($part, '40 0') === 0) {
                $part = '0 0 ' . substr($part, 5);
            }
        }
    }
}

// Join the modified array back into a string
$output = implode(',', $parts);

// Output the result
echo $output;

?>