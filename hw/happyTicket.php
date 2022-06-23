<?php

//if (isset($_GET['min']) && isset($_GET['max'])) {
//    $regex = "/^\d{6}$/";
//    $res1 = preg_match($regex, (int)$_GET["min"]);
//    $res2 = preg_match($regex, (int)$_GET["max"]);
    $count = 0;
    header("Content-Type: application/json");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
   // if ($res1 && $res2) {
//        $min = $_GET['min'];
//        $max = $_GET['max'];
        $min = '000001';
        $max = '001001';

        for ($i = (int)$min; $i <= (int)$max; $i++) {
            $str = sprintf('%06d', $i);
            var_dump($i);
            $arr = str_split($str);
            $arr = array_chunk($arr, 3);
            $arrA = $arr[0];
            $arrB = $arr[1];
            while (count($arrA) > 1 || count($arrB) > 1) {
                $arrA = array_sum($arrA);
                $arrB = array_sum($arrB);
            }
            if ($arrA === $arrB) {
                $count++;
            }
        }
            var_dump($count);
        //echo json_encode($count);
    //}
//}