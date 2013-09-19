<?php

require dirname(__DIR__) . '/config.php';

if (!array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    header("HTTP/1.0 400 Bad Request");
    exit(0);
}
/*
$postdata = array('__EVENTTARGET'      => '',
                  '__EVENTARGUMENT'    => '',
                  'ctl00$tbUsername'   => USERNAME,
                  'ctl00$tbPassword'   => PASSWORD,
                  'ctl00$cbRememberMe' => 'On',
                  'ctl00$btnSignIn'    => 'Login');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, URL_LOGIN);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILENAME);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
$res = curl_exec($ch);
if (!$res) {
    renderAjax(array('success' => false, 'message' => 'Request error: ' . curl_error($ch)));
}
curl_close($ch);

if (!preg_match('/ctl00_ContentBody_lbUsername">.*<strong>.*<\/strong>/', $res)) {
    @unlink(COOKIE_FILENAME);
    renderAjax(array('success' => false, 'message' => 'Your username/password combination does not match. Make sure you entered your information correctly.'));
}*/

if(!array_key_exists('list', $_POST) || empty($_POST['list'])) {
    renderAjax(array('success' => false, 'message' => 'List empty'));
}

$gccodes = str_replace(array(' ', ',', ';'), "\n", $_POST['list']);
$gccodes = str_replace("\n\n", "\n", $gccodes);
$gccodes = preg_replace("/[\n\r]{2,}/","\n",$gccodes);
$gccodes = explode("\n", $gccodes);
$gccodes = array_map('trim', $gccodes);
$gccodes = array_map('strtoupper', $gccodes);
$gccodes = array_unique($gccodes);

$data = array();

foreach($gccodes as $gccode) {
    if(empty($gccode) || strpos($gccode, 'GC') !== 0 || strlen($gccode) <= 3) {
        continue;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, sprintf(URL_GEOCACHE, $gccode));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    //curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILENAME);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $result = curl_exec($ch);
    if (!$result) {
        renderAjax(array('success' => false, 'message' => 'Request error: ' . curl_error($ch)));
    }
    curl_close($ch);

    // if identified:
    // '#<a href="(http://img\.geocaching\.com[^.]+\.(jpg|jpeg|png|gif))"[^>]+>([^<]+)</a>(?:<br />([^<]+)<br /><br />)?#'

    if(preg_match_all('#<li><a href="(http://img\.geocaching\.com[^.]+\.(jpg|jpeg|png|gif))"[^>]+>([^<]+)</a></li>#', $result, $spoilers, PREG_SET_ORDER)
       && preg_match('/cache_logbook\.aspx\?guid=([a-f0-9-]+)"/', $result, $guid)) {
        $rows = array();
        foreach($spoilers as $spoiler) {
            $rows[] = sprintf(SPOILER_TAG, $spoiler[3], $spoiler[1]) . "\n";
        }
        $data[$guid[1]] = array('gccode' => $gccode,
                                'list'   => SPOILER_INFO . "\n" . implode('', $rows));
    }
}

if(empty($data)) {
    renderAjax(array('success' => true, 'list' => false));
}

renderAjax(array('success' => true, 'list' => $data));
