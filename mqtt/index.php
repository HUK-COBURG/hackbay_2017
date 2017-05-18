<?php

require("phpMQTT.php");

echo "MQTT-Server started...";

	
$mqtt = new phpMQTT("172.17.100.252", 1883, "phpMQTT Sub Example"); //Change client name to something unique



if(!$mqtt->connect()){
	exit(1);
}

$topics['smart-e1/#'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics, 0);

$run = 0;

while($mqtt->proc()){
}


$mqtt->close();

function procmsg($topic,$msg){
	
	echo "Msg Recieved: ".date("r")."\nTopic:{$topic}\n$msg\n";
	
	$con = mysqli_connect("localhost","root","PMff3hw6","smarte");
	$sql = "INSERT INTO SensorDaten (SensorZeit, SensorID, SensorWert) VALUES (" . time() . ", '" . $topic . "', " . $msg . ")";
	
	$con->query($sql);
	$con->close();
		
}
	


?>