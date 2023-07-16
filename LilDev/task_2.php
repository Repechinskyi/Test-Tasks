<?php

declare(strict_types=1);

/*
* Finds the maximum value of an array
* @return int
*/

function my_max(array $xs): int {
    
    if (is_array($xs)) {
        $max = null;
        foreach($xs as $val) {

            if (is_array($val)) {
                $val = my_max($val);
            }
            
            if ((null===$max || $val>$max)) {
                $max = $val;
            }

        }
    }
    return $max; 
    
}

echo my_max([1, [2, 3]]); // 3
