<?php

    $input = "-1:21 0,22 0,23 0,24 0,25 8300000,26 0,27 0,28 0,29 0,30 7000,99 1|1597:21 8533000,22 0,23 0,24 0,25 0,26 0,27 0,28 0,29 0,30 70000";

    // Split the input string by spaces
    $parts = explode(' ', $input);
    $TotalConsum = 0;
    
    // Loop through the parts and add to sum if they are numeric
    foreach ($parts as $part) {
        $cleanPart = str_replace(',', '.', $part);
        
        if (is_numeric($cleanPart)) {
            $TotalConsum += (int)$cleanPart; // Cast to float for proper summation
        }
    }

    echo $TotalConsum;
    
?>
