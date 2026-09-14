# Manual de Despliegue con Docker - Proyecto SiGeRU (SiGeRuCSS+)

## Requisitos previos

* Tener instalado Docker Desktop o Docker Engine con el complemento Docker Compose (`docker compose`, sin guion — es el que viene integrado en versiones recientes).
* Tener libres los puertos **8080** (app) y **3308** (MySQL) en tu máquina. Si tenés XAMPP corriendo, su Apache/MySQL usan otros puertos (80/3306) así que no debería chocar, pero si algo más ya usa 8080 o 3308, cambiá el lado izquierdo del mapeo de puertos en `docker-compose.yml` (ej. `"8081:80"`).

## Pasos para ejecutar la aplicación

1. Clonar el repositorio:

   ```
   git clone https://github.com/sofiittaa/Proyecto-UTU
   cd SiGeRuCSS+
   ```

2. Ejecutar la orquestación de contenedores:

   ```
   docker compose up --build -d
   ```

   Esto crea dos contenedores: `sigeru_app` (PHP + Apache, sirve todo el proyecto) y `sigeru_mysql_db` (MySQL 8). La **primera vez** que se crea el contenedor de la base, se importa automáticamente `DumpCSS+.sql` con el esquema y tablas.

3. Verificar que los contenedores estén corriendo:

   ```
   docker compose ps
   ```

   Los dos servicios (`db` y `app`) deben figurar como `Up`.

4. Acceso a los servicios en el navegador:
   * Aplicación completa (index.html, panelAdmin, panelVecino, etc.): <http://localhost:8080>
   * Base de datos MySQL desde el host (para MySQL Workbench / DBeaver / HeidiSQL): `localhost:3308`, usuario `sofiittaa`, contraseña `sofi123.20`, base `SiGeRu`. (El 3308 es el puerto publicado en tu máquina; adentro del contenedor MySQL sigue escuchando en su puerto estándar 3306 — por eso el mapeo en `docker-compose.yml` es `"3308:3306"` y no `"3308:3308"`.)

5. Detener el entorno conservando los datos de la base:

   ```
   docker compose down
   ```

6. Apagar y borrar **todo, incluyendo los datos de la base** (vuelve a importar `DumpCSS+.sql` desde cero la próxima vez que hagas `up`):

   ```
   docker compose down -v
   ```

## Notas / problemas conocidos

* **El dump solo se importa la primera vez.** El volumen `db_data` persiste los datos entre reinicios. Si editás `DumpCSS+.sql` después de haber levantado el entorno una vez, el cambio **no** se aplica hasta que hagas `docker compose down -v` (que borra todos los datos actuales) y volvés a levantar con `up`.
* **Nombre de la base sensible a mayúsculas.** La base se llama `SiGeRu` (mayúsculas mixtas), definida por `MYSQL_DATABASE` en `docker-compose.yml`. `DumpCSS+.sql` no debe incluir su propio `CREATE DATABASE` / `USE` con otro nombre (por ejemplo `sigeru` en minúscula) — MySQL en Linux distingue mayúsculas de minúsculas en nombres de base, y terminarías con una base fantasma vacía de tablas mientras el dump se importa en otra.
* Si en algún momento vas a correr el proyecto directo con XAMPP (sin Docker), `backend/conexion/conexion.php` necesita `host=localhost` en vez de `host=db` — `db` es el nombre del servicio de Docker Compose y solo resuelve dentro de esa red.
