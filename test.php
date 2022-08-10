<?php
$arr = array(3, 2, 1, 2, 9, 2, 1, 2, 2);

$string = "Whr dd th bg Elphnt gs?";





  
$a = (substr_count($string, 'a') + 
    substr_count($string, 'i') +
    substr_count($string, 'u') + 
    substr_count($string, 'e') +
    substr_count($string, 'o') 
);
$today= date('y-m-d');
$today2= date('y-m-d', strtotime("-1 day"));
var_dump($today);






?>
