<?php

function calculateDiscount($price, $discount_percentage)
{
    return (
        $price - round(
            (
                (float) $discount_percentage * $price
            ) / 100
        )
    );
}

function calculateNominalDiscount($price, $discount_percentage)
{
    return (
        round(
            (
                (float) $discount_percentage * $price
            ) / 100
        )
    );
}

function rupiah_number_format($number)
{
    return "Rp" . number_format($number, 0, ',', '.');
}

function image_full_path($image_path = null)
{
    if($image_path) {
        return asset_cdn($image_path);
    } else {
        return asset('pintaria/img/shared/empty-state.jpg');
    }
}

function youtube_url_generator($youtube_id)
{
    return "https://www.youtube.com/watch?v=" . $youtube_id;
}

function youtube_embed_url_generator($youtube_id)
{
    return "https://www.youtube.com/embed/" . $youtube_id;
}

function isCaptchaStillValid($captcha_response)
{
    return ((time() - Session::get($captcha_response."_start_time")) < 120);
}

function setCaptchaValidInSession($captcha)
{
    Session::put($captcha."_start_time", time());
}

function removeCaptchaInSession($captcha)
{
    Session::forget($captcha."_start_time");
}

function lmsLearningActivityUrl($klass_id)
{
    return config('services.lms.url').'/public/learning_activity/'.$klass_id;
}

/**
 * The purpose of this signature key is to validate whether the notification is originated from Midtrans or not.
 * Should the notification is not genuine, merchants can disregard the notification.
 * @param  string $orderId     Order id
 * @param  string $statusCode  Status code
 * @param  string $grossAmount Gross amount
 * @param  string $serverKey   Server key
 * @return string              Signature key
 */
function generate_notification_signature_key($orderId, $statusCode, $grossAmount, $serverKey, $method = 'sha512') {
    $input = $orderId.$statusCode.$grossAmount.$serverKey;
    return openssl_digest($input, $method)?: "";
}

/**
 * 200
 * Credit Card: Success. Request is successful.
 * Other payment methods: Success. Transaction is successful/settlement.
 * 201
 * Credit Card: Challenge. Transaction is successfully sent to bank but the process has not been completed.
 * Bank Transfer: Pending. Transaction is successfully sent to bank but the process has not been completed by the customer.
 * Cimb Clicks: Pending. Transaction successfully sent to bank but the process has not been completed by the customer.
 * BRI ePay: Pending. Transaction successfully sent to bank but the process has not been completed by the customer.
 * Klik BCA: Pending. Transaction successfully sent to bank but the process has not been completed by the customer.
 * BCA Klikpay: Pending. Transaction successfully sent to bank but the process has not been completed by the customer.
 * Mandiri Bill Payment: Pending. Transaction successfully sent to bank but the process has not been completed by the customer.
 * Indomaret: Pending. Transaction successfully sent to provider but the process has not been completed by the customer.
 * 202
 * Credit Card: Denied. Transaction has been processed but is denied by payment provider or midtrans’ fraud detection system.
 * Other payment methods: Denied. Transaction has been processed but is denied by payment provider.
 *
 * @param  int    $status_code Status code from Midtrans
 * @return string
 */
function translate_midtrans_status_code(int $status_code) {
    switch ($status_code) {
        case 200:
            return 'success';
        case 201:
            return 'pending';
        case 202:
            return 'failed';
        default:
            return 'pending';
    }
}

function getRequestPath($next_domain, $previous_url) {
    return $next_domain . str_replace(url(''), '', $previous_url);
}

function addClassIframe($string){
    return substr_replace($string, 'class="c-content-contact-1-gmap"', 8, 0);
}

function convertMonthDate($month) {
    switch ($month) {
        case 1:
            return 'Januari';
            break;
        case 2:
            return 'Februari';
            break;
        case 3:
            return 'Maret';
            break;
        case 4:
            return 'April';
            break;
        case 5:
            return 'Mei';
            break;
        case 6:
            return 'Juni';
            break;
        case 7:
            return 'Juli';
            break;
        case 8:
            return 'Agustus';
            break;
        case 9:
            return 'September';
            break;
        case 10:
            return 'Oktober';
            break;
        case 11:
            return 'November';
            break;
        case 12:
            return 'Desember';
            break;
    }
}

function convertDateFormat($date, $format) {
    $time = strtotime($date);
    $month = date('m', $time);

    $structured_date = '';
    switch ($format) {
        case 'd F Y, H:i T':
            $structured_date = date('d ', $time) . convertMonthDate($month) . $date->format(' Y, H:i T');
            break;
        default:
            $structured_date = date('d F Y H:i', $time);
            break;
    }
    return $structured_date;
}

function friendlyUrl($name) {
    $name = trim($name);

    $find = [' ', '&', "\r\n", "\n", '+', ','];
    $name = str_replace($find, '-', $name);

    $find = ['/[^a-zA-Z0-9\-_<>.]/', '/[\-]+/', '/<[^>]*>/'];
    $repl = ['', '-', ''];
    $name = preg_replace($find, $repl, $name);
    return $name;
}

function asset_cdn($path) {
    return config('services.gcs_image_domain.url') . '/' . $path;
}

function generateECertificateNumber($course_code, $product_module_number, $now, $running_number) {
    return $course_code . '-' . $product_module_number . '-' . $now . '-' . $running_number;
}

function getProductsName($name, $loop, $total, $prefix = '(', $suffix = ')'){
    $names = '';

    if($loop == 0){
        $names .= $prefix . $name;
    }

    if($loop > 0 && $loop < $total){
        $names .= ', ' . $name;
    }

    if($loop == $total){
        $names .= $name . $suffix;
    }

    return $names;
}

function removeHttp($url) {
    $disallowed = array('http://', 'https://');
    foreach($disallowed as $d) {
        if(strpos($url, $d) === 0) {
            return str_replace($d, '', $url);
        }
    }
    return $url;
}

function queryToArray($qry)
{
    $result = array();
    //string must contain at least one = and cannot be in first position
    if(strpos($qry,'=')) {

        if(strpos($qry,'?')!==false) {
            $q = parse_url($qry);
            $qry = $q['query'];
        }
    }else {
        return false;
    }

    foreach (explode('&', $qry) as $couple) {
        list ($key, $val) = explode('=', $couple);
        $result[$key] = $val;
    }

    return empty($result) ? false : $result;
}

function buildQueryParameter($url, $params){
    $baseUrl = explode('?', $url);

    $baseQuery = queryToArray($url);

    if(is_array($baseQuery) && is_array($params)){
        $params = array_merge($baseQuery, $params);
    }

    $string = http_build_query( $params );


    return $baseUrl[0] . '?' . urldecode($string);
}

function dayInIndonesian($str)
{
    $days = [
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jum\'at',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu',
    ];

    foreach ($days as $day => $hari) {
        if ($day == $str) {
            return $hari;
        }
    }

    return null;
}

function validateCaptcha($captcha_response, $json = true)
{
    if(isset($captcha_response) && !app()->environment('testing')) {
        $secretKey = env("RECAPTCHA_SERVER_KEY");
        $response = $_POST['g-recaptcha-response'];     
        $remoteIp = $_SERVER['REMOTE_ADDR'];

        $reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
        $result = json_decode($reCaptchaValidationUrl, TRUE);
        
        if($result['success'] == false) {
            if ($json) {
                return response()->json(['status' => 422, 'message' => 'Silahkan mengulangi captcha kembali.']);
            } else {
                return redirect()->back()->withErrors(['recaptcha' => ['Silahkan mengulangi captcha kembali.']]);
            }
        }
    }
}

function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}
