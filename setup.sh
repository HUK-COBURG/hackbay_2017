#!/bin/bash

#updating system
sudo apt-get update
sudo apt-get upgrade -y
sudo apt-get dist-upgrade -y
sudo apt-get autoremove -y

#setup mosquitto
sudo apt-get install mosquitto mosquitto-clients -y
sudo systemctl stop mosquitto
sudo update-rc.d mosquitto remove
sudo rm -f /etc/init.d/mosquitto
sudo rm -f /etc/systemd/system/mosquitto.service
sudo cat > /etc/systemd/system/mosquitto.service <<- "EOF"
[Unit]
Description=MQTT v3.1 message broker
After=network.target
Requires=network.target

[Service]
Type=simple
ExecStart=/usr/sbin/mosquitto -c /etc/mosquitto/mosquitto.conf
Restart=always

[Install]
WantedBy=multi-user.target
EOF
sudo systemctl daemon-reload
sudo systemctl enable mosquitto
sudo systemctl start mosquitto.service

#setup apache
sudo apt-get install apache2 -y
sudo chown -R pi:www-data /var/www/html/
sudo chmod -R 770 /var/www/html/
sudo a2enmod rewrite
sudo grep -F '<Directory /var/www/html>' /etc/apache2/sites-enabled/000-default.conf || sudo sed -i -e 's/<\/VirtualHost>/\n\t<Directory \/var\/www\/html>\n\t\tOptions Indexes FollowSymLinks MultiViews\n\t\tAllowOverride All\n\t\tRequire all granted\n\t<\/Directory>\n\n<\/VirtualHost>/' /etc/apache2/sites-enabled/000-default.conf
sudo systemctl restart apache2

#setup php
sudo apt-get install php php-mbstring -y
sudo systemctl restart apache2

#setup mysql
sudo apt-get install mysql-server php-mysql -y
sudo systemctl stop mysql
sudo pkill -f mysql &
wait %1
sleep 1
sudo mysqld_safe --skip-grant-tables &
sleep 5
mysql -e "FLUSH PRIVILEGES;DROP USER 'root'@'localhost';CREATE USER 'root'@'localhost' IDENTIFIED BY 'raspberry';GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost';UPDATE mysql.user SET Grant_priv='Y' WHERE User='root';FLUSH PRIVILEGES;"
mysqladmin -u root -praspberry shutdown
sleep 2
sudo systemctl start mysql

#setup phpmyadmin
debconf-set-selections <<< "phpmyadmin phpmyadmin/internal/skip-preseed boolean true"
debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect"
debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean false"
sudo apt-get install phpmyadmin -y
sudo ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin
sudo systemctl restart apache2

#setup dashboard
sudo \cp -r html /var/www
mysql -u root -praspberry -e "DROP USER IF EXISTS 'smarte'@'%';DROP DATABASE IF EXISTS smarte;CREATE USER 'smarte'@'%' IDENTIFIED BY 'smarte';GRANT USAGE ON *.* TO 'smarte'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS smarte;GRANT ALL PRIVILEGES ON smarte.* TO 'smarte'@'%';"
mysql -u smarte -psmarte < /var/www/html/smarte/scripts/smarte.sql

#setup wifi-ap
sudo apt-get install hostapd -y
sudo apt-get install dnsmasq -y
sudo systemctl stop hostapd
sudo systemctl stop dnsmasq
sudo rm -f /etc/dhcpcd.conf
sudo cat > /etc/dhcpcd.conf <<- "EOF"
interface wlan0
static ip_address=192.168.1.1/24
denyinterfaces wlan0
EOF
sudo service dhcpcd restart
if [ ! -e /etc/dnsmasq.conf.orig ]
then
	sudo mv /etc/dnsmasq.conf /etc/dnsmasq.conf.orig
fi
sudo rm -f /etc/dnsmasq.conf
sudo cat > /etc/dnsmasq.conf <<- "EOF"
interface=wlan0
dhcp-range=192.168.1.10,192.168.1.100,255.255.255.0,24h
EOF
sudo grep -F '192.168.1.1' /etc/hosts || sudo /bin/bash -c 'echo "192.168.1.1     smarte" >> /etc/hosts'
sudo systemctl start dnsmasq
sudo systemctl enable dnsmasq
sudo rm -f /etc/hostapd/hostapd.conf
sudo cat > /etc/hostapd/hostapd.conf <<- "EOF"
interface=wlan0
hw_mode=g
ieee80211n=1
ieee80211d=1
country_code=DE
channel=7
wmm_enabled=1
auth_algs=1
wpa=2
wpa_key_mgmt=WPA-PSK
rsn_pairwise=CCMP
ssid=SMART-E
wpa_passphrase=smarte123
EOF
sudo sed -i -e 's/[#]\{0,1\}DAEMON_CONF=.*/DAEMON_CONF="\/etc\/hostapd\/hostapd.conf"/' /etc/default/hostapd
sudo systemctl unmask hostapd
sudo systemctl start hostapd
sudo systemctl enable hostapd

#setup samba
sudo apt-get install samba samba-common smbclient -y
if [ ! -e /etc/samba/smb.conf.orig ]
then
	sudo mv /etc/samba/smb.conf /etc/samba/smb.conf.orig
fi
sudo rm -f /etc/samba/smb.conf
sudo cat > /etc/samba/smb.conf <<- "EOF"
[global]
workgroup = WORKGROUP
security = user
encrypt passwords = yes
client min protocol = SMB2
client max protocol = SMB3

[html]
comment = Samba-Pi-Freigabe
path = /var/www/html/
read only = no
EOF
printf "raspberry\nraspberry\n" | sudo smbpasswd -a -s pi
sudo service smbd restart
sudo service nmbd restart

#setup autostart
sudo mkdir /home/pi/.config/autostart/
sudo rm -f /home/pi/.config/autostart/chromium.desktop
sudo cat > /home/pi/.config/autostart/chromium.desktop <<- "EOF"
[Desktop Entry]
Encoding=UTF-8
Name=Connect
Comment=Checks internet connectivity
Exec=/usr/bin/chromium-browser -incognito --start-fullscreen http://smarte/
EOF

#setup python for listener
sudo apt-get install python-pip -y
sudo pip install paho-mqtt mysql-connector
sudo rm -f /etc/systemd/system/mqttlistener.service
sudo cat > /etc/systemd/system/mqttlistener.service <<- "EOF"
[Unit]
Description=Smart-E MQTT Listener
After=mysql.service

[Service]
Type=simple
ExecStart=/usr/bin/python /var/www/html/smarte/scripts/listener.py
Restart=always

[Install]
WantedBy=multi-user.target
EOF
sudo systemctl enable mqttlistener
sudo systemctl start mqttlistener

#copy font
#sudo cp /var/www/html/smarte/assets/fonts/themify.ttf /usr/share/fonts/truetype/
#sudo cp /var/www/html/smarte/assets/fonts/fontawesome-webfont.ttf /usr/share/fonts/truetype/


echo "setup finished"