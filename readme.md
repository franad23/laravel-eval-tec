## Consideraciones previas

El proyecto al estar dockerizado se debe tener el mismo antes, por lo tanto correr **docker -v** y verificar si el mismo esta instalado sino se puede instalar desde [aqui](https://docs.docker.com/)

## Paso 1 – Levantar el entorno

Una vez instalado docker correr el siguiente comando en el root del proyecto:
```
	docker compose up --build
```

## Paso 2 – Ejecutar migraciones y levantar el worker

Cuando el proyecto ya se encuentre levando y el mismo haya instalado todas las dependencias correr lo siguiente para correr las migraciones y el queue worker:
```
	docker exec laravel_app php artisan migrate
```
```
	docker exec laravel_app php artisan queue:work
```

## Endpoints disponibles

La API expone dos endpoints accesibles desde **http://localhost:8000/**

 - POST **/api/event-registration**  el mismo espera un body con la siguiente estructura:
	 ```
	 {
		  "name":STRING,
		  "lastname": STRING,
		  "email": STRING,
		  "dni": NUMBER
	}
	 ```
- GET  **/api/event-registration** el mismo necesita una query con la siguiente estructura ?id=NUMBER por ejemplo:
	```
		http://localhost:8000/api/event-registration?id=2
	```
### Recordá
	Si se usa postman o thunderclient para realizar las consultas recordar de colocar en los HEADERS **Accept:application/json** para ver las respuestas JSON de manera correcta.


## Visualizar contador

El contador que se solicito se encuentra en un redis en la url **http://localhost:8081/** bajo la key **laravel-database-Event total count**
