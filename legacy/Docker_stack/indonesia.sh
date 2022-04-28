sudo service nginx stop
sudo service mariadb stop
docker run -d -p 80:80 -p 3306:3306 -p 2222:22 \
		-v /home/sylvain/ART-Dev/Work/2022/2022_bd_roger/Database_system_20180923/:/var/www/html \
		-v /home/sylvain/ART-Dev/Work/2022/2022_bd_roger/Database_system_20180923//logs:/var/log/apache2 \
		-v /home/sylvain/ART-Dev/Work/2022/2022_bd_roger/Database_system_20180923/mysql \
		bix_com_uy/lamp53:latest
