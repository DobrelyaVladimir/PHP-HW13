<?php

if (isset($_GET['min']) && isset($_GET['max'])) {
    $regex = "/^\d{6}$/";
    $res1 = preg_match($regex, sprintf('%06d', (int)$_GET["min"]));
    $res2 = preg_match($regex, sprintf('%06d', (int)$_GET["max"]));
    $count = 0;
    header("Content-Type: application/json");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    if ($res1 && $res2) {
        $min = $_GET['min'];
        $max = $_GET['max'];

        for ($i = (int)$min; $i <= (int)$max; $i++) {
            $str = sprintf('%06d', $i);
            $arr = str_split($str);
            $arr = array_chunk($arr, 3);
            $arrA = $arr[0];
            $arrB = $arr[1];
            $arrA = array_sum($arrA);
            $arrB = array_sum($arrB);

            while (strlen((string)$arrA) > 1) {
                $arrA = str_split($arrA);
                $arrA = array_sum($arrA);

            }
            while (strlen((string)$arrB) > 1) {
                $arrB = str_split($arrB);
                $arrB = array_sum($arrB);
            }

            if ($arrA === $arrB) {
                $count++;
            }
        }


    }
    echo json_encode($count);
}
