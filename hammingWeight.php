<?php

function hammingWeight($num)
{
    $sum = function ($carry, $item){
        if ($item == 1){$carry += $item;}
        return $carry;
    };
    $bin = base_convert($num, 10, 2);
    return array_reduce(str_split($bin), $sum, 0);
}
