<?php
function seconds2time($seconds)
    {
        $minutes = floor($seconds/60);
        $jam = floor($minutes/60);
        $minutes = $minutes - ($jam*60);
        $seconds = floor($seconds % 60);
        $jam = $jam < 10 ? "0" . $jam : $jam;
        $minutes = $minutes < 10 ? "0" . $minutes : $minutes;
        $seconds = $seconds < 10 ? "0" . $seconds : $seconds;
        return $jam . ":" . $minutes . ":" . $seconds;
    }
?>
