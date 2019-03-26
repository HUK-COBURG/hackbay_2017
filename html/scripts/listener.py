#!/usr/bin/python
# -*- coding: utf-8 -*-
 
import paho.mqtt.client as mqtt
import mysql.connector as mariadb
import time


connection = mariadb.connect(user='smarte', password='smarte', database='smarte')

cursor = connection.cursor()
sql = "SELECT id, topic FROM sensors WHERE active = 1"
cursor.execute(sql)
sensors = cursor.fetchall()
cursor.close()


def on_message(client, userdata, message):
	msg = str(message.payload.decode("utf-8"))
	print("received " + message.topic + ": " + msg)
	for id, topic in sensors:
		if topic == message.topic:
			cursor = connection.cursor()
			sql = "INSERT INTO measurements (time, value, sensor) VALUES ({0}, '{1}', {2})".format(int(time.
			time()),msg.replace(',','.'),id)
			print(sql)
			cursor.execute(sql)
			connection.commit()

 
def on_connect(client, userdata, flags, rc):
	for id, topic in sensors:
		print("subscribed to " + topic)
		client.subscribe(topic)
 
BROKER_ADDRESS = "localhost"
 
client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message
 
client.connect(BROKER_ADDRESS)
 
print("connected to MQTT Broker: " + BROKER_ADDRESS)
 
client.loop_forever()