<?php

require("phpMQTT.php");

echo "MQTT-Server started...";

	
$mqtt = new phpMQTT("localhost", 1883, "phpMQTT Sub Example"); //Change client name to something unique



if(!$mqtt->connect()){
        echo "MQTT-Server connection failed...";
	exit(1);
}

$topics['#'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics, 0);

$run = 0;

while($mqtt->proc()){
}


$mqtt->close();

function procmsg($topic,$msg){
	
	echo "Msg Recieved: ".date("r")."\nTopic:{$topic}\n$msg\n";
	
	$con = mysqli_connect("localhost","smarte","smarte","smarte");
	$sql = "INSERT INTO SensorDaten (SensorZeit, SensorID, SensorWert) VALUES (" . time() . ", '" . $topic . "', " . $msg . ")";
	
	$con->query($sql);
	$con->close();
		
}
	


?>
