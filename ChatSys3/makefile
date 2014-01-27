PHP=php --define allow_url_fopen=On

world: composer.phar composer.json
	make install-composer

composer.phar:
	curl -sS https://getcomposer.org/installer | ${PHP}

composer.json:
	echo 'composer.json not found.'

install-composer: composer.phar composer.json
	${PHP} composer.phar install

update-composer: composer.phar composer.json
	${PHP} composer.phar update
