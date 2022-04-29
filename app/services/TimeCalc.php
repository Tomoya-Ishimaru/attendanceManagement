<?php

namespace App\Services;

class TimeCalc
{
    public static function getDayTotal($startTime, $endTime)
    {


        $diff_hours   = $startTime->diffInHours($endTime);
        $diff_minutes = $startTime->diffInMinutes($endTime);
        $diff_minutes = ($diff_minutes < 60) ? $diff_minutes : $diff_minutes % 60; // 100分なら1時間分の60を切り落とし40分とする
        $diff_seconds = $startTime->diffInSeconds($endTime);
        $diff_seconds = substr($diff_seconds, -2);
        $diff_seconds = ($diff_seconds < 60) ? $diff_seconds : $diff_seconds % 60;


        // 日付差分を自然な日本語にする(0の日時分は非表示とする)
        $result_string = '';
        $result_string .= $diff_hours . ":" . $diff_minutes . ":" . $diff_seconds;

        return $result_string;
    }

    public static function hour_to_sec(string $str): int
    {
        $t = explode(":", $str); //配列（$t[0]（時）、$t[1]（分）、$t[2]（秒））にする
        $h = (int)$t[0];
        if (isset($t[1])) { //分の部分に値が入っているか確認
            $m = (int)$t[1];
        } else {
            $m = 0;
        }
        if (isset($t[2])) { //秒の部分に値が入っているか確認
            $s = (int)$t[2];
        } else {
            $s = 0;
        }
        return ($h * 60 * 60) + ($m * 60) + $s;
    }


    public static   function sec_to_hour(int $sec)
    {
        $hours = floor($sec / 3600); //時間
        $minutes = floor(($sec / 60) % 60); //分
        $seconds = floor($sec % 60); //秒
        $hms = sprintf("%2d:%02d:%02d", $hours, $minutes, $seconds);
        return $hms;
    }
}
