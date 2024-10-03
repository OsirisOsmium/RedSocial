# Proyyecto Red Social - DomHome

# Instalación y Configuración de XAMPP y MongoDB

## Tabla de Contenidos
- [Requisitos Previos](#requisitos-previos)
- [Instalación de XAMPP](#instalación-de-xampp)
  - [Descarga e Instalación](#descarga-e-instalación)
  - [Configuración Básica](#configuración-básica)
- [Instalación de MongoDB](#instalación-de-mongodb)
  - [Descarga e Instalación](#descarga-e-instalación-1)
  - [Configuración Básica](#configuración-básica-1)
- [Conexión de PHP a MongoDB](#conexión-de-php-a-mongodb)
- [Referencias](#referencias)

## Requisitos Previos
- Un sistema operativo Windows, macOS o Linux.
- Acceso a Internet para descargar los instaladores.
- Permisos de administrador en tu computadora para instalar software.

## Instalación de XAMPP

### Descarga e Instalación
1. **Descargar XAMPP**:
   - Visita la [página oficial de XAMPP](https://www.apachefriends.org/index.html).
   - Selecciona el instalador adecuado para tu sistema operativo (Windows, macOS, Linux).

2. **Instalar XAMPP**:
   - Ejecuta el instalador descargado.
   - Sigue las instrucciones del asistente de instalación.
   - Selecciona los componentes que deseas instalar (por defecto, se instalan Apache, MySQL, PHP y phpMyAdmin).
   - Completa la instalación.

### Configuración Básica
1. **Iniciar XAMPP**:
   - Abre el Panel de Control de XAMPP.
   - Inicia los servicios de Apache y MySQL.

2. **Verificar Instalación**:
   - Abre un navegador web y visita `http://localhost`. Deberías ver la página de bienvenida de XAMPP.

## Instalación de MongoDB

### Descarga e Instalación
1. **Descargar MongoDB**:
   - Visita la [página oficial de MongoDB](https://www.mongodb.com/try/download/community).
   - Selecciona la versión adecuada para tu sistema operativo.

2. **Instalar MongoDB**:
   - Ejecuta el instalador descargado.
   - Sigue las instrucciones del asistente de instalación.
   - Asegúrate de instalar MongoDB como un servicio (opción recomendada).

### Configuración Básica
1. **Configurar el Directorio de Datos**:
   - Crea un directorio para los datos de MongoDB, por ejemplo, `C:\data\db` en Windows o `/data/db` en macOS/Linux.

2. **Iniciar MongoDB**:
   - Abre una terminal o símbolo del sistema.
   - Ejecuta el comando `mongod` para iniciar el servidor de MongoDB.

3. **Verificar Instalación**:
   - Abre otra terminal o símbolo del sistema.
   - Ejecuta el comando `mongo` para acceder a la shell de MongoDB.

## Conexión de PHP a MongoDB
1. **Instalar el Driver de MongoDB para PHP**:
   - Asegúrate de tener instalado Composer. Si no lo tienes, [descárgalo e instálalo](https://getcomposer.org/).
   - Abre una terminal o símbolo del sistema en el directorio de tu proyecto.
   - Ejecuta el comando:
     ```sh
     composer require mongodb/mongodb
     ```

2. **Escribir un Script PHP para Conectar a MongoDB**:
   - Crea un archivo PHP, por ejemplo `mongo_test.php`, con el siguiente contenido:
     ```php
     <?php
     require 'vendor/autoload.php'; // Incluye el autoload de Composer

     $client = new MongoDB\Client("mongodb://localhost:27017");

     $collection = $client->test->users;

     $result = $collection->insertOne(['name' => 'John Doe', 'email' => 'john@example.com']);

     echo "Inserted with Object ID '{$result->getInsertedId()}'";
     ```
   - Coloca este archivo en el directorio `htdocs` de XAMPP.
   - Abre un navegador web y visita `http://localhost/mongo_test.php` para ejecutar el script.

## Referencias
- [Documentación oficial de XAMPP](https://www.apachefriends.org/es/index.html)
- [Documentación oficial de MongoDB](https://docs.mongodb.com/)
- [Composer](https://getcomposer.org/)