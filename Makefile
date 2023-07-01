SERVICE=
CONTAINER=
CFILE=docker-compose.yml

up:
	./vendor/bin/sail -f ${CFILE} up -d

down:
	./vendor/bin/sail -f ${CFILE} down -v

key.generate:
	./vendor/bin/sail artisan key:generate

breeze:
	./vendor/bin/sail artisan breeze:install

npm.build:
	./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev

migrate:
	./vendor/bin/sail artisan migrate

migrate.seed:
	./vendor/bin/sail artisan migrate --seed

seed.user:
	./vendor/bin/sail artisan db:seed --class=UserSeeder
