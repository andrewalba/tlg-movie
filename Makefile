SERVICE=
CONTAINER=
CFILE=docker-compose.yml

up:
	./vendor/bin/sail -f ${CFILE} up -d

down:
	./vendor/bin/sail -f ${CFILE} down -v

