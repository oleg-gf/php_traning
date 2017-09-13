<?php
function bestAttempt ($firstClubAttempts, $secondClubAttempts){
    $result = array_map(function ($a, $b){
            $a = array_values($a);
            $b = array_values($b);
            if ($a[1] > $b[1]) { return $a[0]; }
            if ($a[1] < $b[1]) { return $b[0]; }
        }, $firstClubAttempts, $secondClubAttempts
        );
    $result2 = array_filter($result, function ($item){ return $item !== null; });
    print_r(array_values($result2));
    return array_values($result2);
}
/*
Реализуйте функцию bestAttempt которая принимает на вход результаты попыток и возвращает массив со списком имен футбольных клубов, которые победили в каждой из попыток. Если результатом попытки была ничья, то в результирующем массиве она не фигурирует (потому что никто не победил).
*/
