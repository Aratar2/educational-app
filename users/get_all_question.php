<?php
header("Content-Type: text/html; charset=utf-8");



if(isset($_GET["access_token"])){

    $token=$_GET["access_token"];
    $kod=$_GET["kod"];

    require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";



    $resultToken = mysql_query("SELECT `token` FROM `users` WHERE `token`='$token'");
    if(mysql_num_rows($resultToken) > 0) {

        $response = array();
        $result = mysql_query("SELECT *FROM test WHERE `pid`='$kod'") or die(mysql_error());


        while ($row = mysql_fetch_array($result)) {
            $info = array();
            $info["question"] = $row["question"];
            $info["answer1"] = $row["answer1"];
            $info["answer2"] = $row["answer2"];
            $info["answer3"] = $row["answer3"];
            $info["answer4"] = $row["answer4"];
            array_push($response, $info);
        }

        echo json_encode(array('questions' =>$response));

    }
    else{

        echo "Access denied, incorrect access token";

    }

}
else{

    echo "Access denied, access token not found";

}

?>