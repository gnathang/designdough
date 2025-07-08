<?php
    $user_ip = getenv('REMOTE_ADDR');
    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
    $country = $geo["geoplugin_countryName"];
    $city = $geo["geoplugin_city"];

    if ($country === 'United Kingdom') {
        $country = 'UK';
    };
?>

<!-- load the clock on page load, then update every 1s using the associated script -->
<div class="analogue_clock" onload="setAnalogueClock()">
    <div class="circle" id="hr_hand" data-hour-hand><i></i></div>
    <div class="circle" id="mn_hand" data-minute-hand><i></i></div>
    <div class="circle" id="sc_hand" data-second-hand><i></i></div>
</div>
<p id="clock" onload="currentTime()"></p>
<p id="location"><?php // echo $city; ?>Cardiff, <?php // echo $country; ?>UK</p>