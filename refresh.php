<?php
define('WP_USE_THEMES', false);
(string) $caminho = dirname(__FILE__);
require_once($caminho . '/../../../wp-blog-header.php');

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


$jetimob_options = get_option('jetimob_option_name');
$api = $jetimob_options['api'];

$url = "https://api.jetimob.app/webservice/{$api}/imoveis?a=" . generateRandomString();

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // <-- IMPORTANTE
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200) {
    file_put_contents($caminho.'/jetimob.json', $response);
    echo "Baixado com sucesso";
} else {
    echo "Erro HTTP: $httpCode";
}

date_default_timezone_set('America/Sao_Paulo');
$date = date('d/m/Y h:i:s a', time());
echo $date . ' - operação de download realizada.' . PHP_EOL;
?>