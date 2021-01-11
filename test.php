<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "https://rest-app.net/api/ads?login=".urlencode("rabz89@yandex.ru")."&token=665bdd837b4c50938d09b36d84d34f75&category_id=24&format=json&limit=10&region_id=637680&city_id=638920");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
?>


<pre>
    <?php echo $output ?>
</pre>
