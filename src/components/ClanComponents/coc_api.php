<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

if (empty($_POST['ClanID']) && empty($_POST['PlayerID'])) die();

if ($_POST){

	// set response code - 200 OK

	http_response_code(200);

    $playerID = $_POST['PlayerID'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.clashofclans.com/v1/players/%23'.$playerID,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer token'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;


	// echo json_encode(array(
	// 	"sent" => true
	// ));
} else {

	// tell the user about error

	echo json_encode(["sent" => false, "message" => "Something went wrong"]);
}
?>