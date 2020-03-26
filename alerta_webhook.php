<?php

$json_data = file_get_contents("php://input");
if (empty($json_data))
    die();

// Log do webhook da action 
$file = 'access.log';
$current = file_get_contents($file);
$current .= date('[j/M/Y H:i:s]'). " $json_data \n";
file_put_contents($file, $current);


$data = json_decode($json_data);
$check_state = $data->webhook_event_data->check_state_name;
$request_url = $data->webhook_event_data->request_url;
$request_start_time = date(
    'Y-m-d H:i:s T', 
    strtotime( $data->webhook_event_data->request_start_time )
);
$check_name = $data->webhook_event_data->check_name;

$mensagem2 = "Status  $check_state \n";
$mensagem2 .= "URL site: $request_url \n";
$mensagem2 .= "data hora: $request_start_time \n";

//ID Chat do telegram
$chat_id="CHAT ID TELEGRAM";

//Token do telegram

$token="TOKEN TELEGRAM";

//Enviando msg para chat do telegram

$url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$mensagem2."";

$execucao = file_get_contents($url);

