# Proyecto Laravel - Calculadora de Viaje

Este proyecto es una aplicación web desarrollada en Laravel que permite calcular el presupuesto de viaje en diferentes monedas y mostrar el clima actual en una ciudad seleccionada.

## Requisitos

- PHP 7.x
- Composer
- Laravel
- MySQL
- jQuery
- RapidAPI (for WeatherAPI and ExchangeRateAPI)

## Instalación

### 1. Clonar el Repositorio

Clona el repositorio en tu máquina local:

```bash
git clone https://github.com/jh0nm4r1n/travel-calc-test.git
cd travel-calc-test
```

### 2. Instalar Dependencias
Asegúrate de tener Composer instalado en tu sistema. Si no lo tienes, puedes descargarlo e instalarlo desde Composer.

Una vez que tengas Composer instalado, ejecuta el siguiente comando para instalar las dependencias del proyecto:

```bash
composer install
```

### 3. Configurar el Entorno
Copia el archivo .env.example y renómbralo a .env:

```bash
cp .env.example .env
```

Luego, abre el archivo .env y configura los parámetros de la base de datos. Busca las siguientes líneas y actualízalas con los detalles de tu base de datos:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_calc
DB_USERNAME=root
DB_PASSWORD=root
```

### 4. Generar la Clave de la Aplicación

Genera la clave de la aplicación con el siguiente comando:

```bash
php artisan key:generate
```

### 5. Ejecutar Migraciones y Seeders

Para crear las tablas en la base de datos, ejecuta las migraciones con:

```bash
php artisan migrate
```

Para poblar la base de datos con datos iniciales, ejecuta los seeders con:

```bash
php artisan db:seed
```

### 6. Iniciar el Servidor de Aplicación

Inicia el servidor de desarrollo de Laravel con el siguiente comando:


```bash
php artisan serve
```

El proyecto estará disponible en http://localhost:8000 o http://127.0.0.1:8000.

## Uso

1. Formulario de Viaje: Completa el formulario de viaje con la ciudad y el presupuesto.

2. Resultados: Los resultados se mostrarán en una pantalla separada, incluyendo el clima, la moneda local, el presupuesto convertido y la tasa de cambio.
