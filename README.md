# Vinilos API Backend

**Autor:** Adrian Montes Bastida

Este proyecto es una API backend desarrollada en **Laravel 11** para gestionar una tienda de vinilos. Permite manejar usuarios, vinilos, proveedores, pedidos, direcciones de envío, valoraciones y detalles de pedido.

---

## 📦 Funcionalidades principales

* ✅ Autenticación de usuarios con roles (admin y usuario).
* ✅ Gestión de vinilos: listar, crear, actualizar, eliminar (admin).
* ✅ Gestión de proveedores (admin).
* ✅ Gestión de usuarios, direcciones, pedidos, valoraciones.
* ✅ Carrito de compras y tramitación de pedidos.
* ✅ Protección con middleware `auth:sanctum` y `is_admin`.

---

## ⚙ Instalación del proyecto

1️⃣ Clonar el repositorio:

```bash
git clone <URL_DEL_REPO>
```

2️⃣ Entrar al proyecto:

```bash
cd vinilos-backend
```

3️⃣ Instalar dependencias:

```bash
composer install
```

4️⃣ Configurar archivo `.env`:

```bash
cp .env.example .env
```

Edita el `.env` y pon tu base de datos, por ejemplo:

```ini
DB_CONNECTION=sqlite
DB_DATABASE=/ruta/completa/a/database.sqlite
```

5️⃣ Crear la base de datos (si usas SQLite):

```bash
touch database/database.sqlite
```

6️⃣ Ejecutar migraciones:

```bash
php artisan migrate
```

7️⃣ (Opcional) Poblar datos con seeders:

```bash
php artisan db:seed
```

8️⃣ Levantar el servidor:

```bash
php artisan serve
```

El backend estará disponible en:

```
http://localhost:8000
```

---

## 🔐 Autenticación

* Obtener un token:

  ```
  POST /api/login
  ```

* Registrarse:

  ```
  POST /api/register
  ```

* Las rutas protegidas requieren:

  ```
  Authorization: Bearer <token>
  ```

---

## 🔗 Endpoints disponibles

### ✅ Auth

| Método | Ruta          | Descripción                |
| ------ | ------------- | -------------------------- |
| POST   | /api/login    | Login de usuario           |
| POST   | /api/register | Registro de usuario        |
| POST   | /api/logout   | Logout del usuario (token) |
| GET    | /api/me       | Obtener datos del usuario  |

---

### 🎵 Vinilos

| Método | Ruta              | Descripción               |
| ------ | ----------------- | ------------------------- |
| GET    | /api/vinilos      | Listar todos los vinilos  |
| GET    | /api/vinilos/{id} | Ver detalle de un vinilo  |
| POST   | /api/vinilos      | Crear vinilo (admin)      |
| PUT    | /api/vinilos/{id} | Actualizar vinilo (admin) |
| DELETE | /api/vinilos/{id} | Eliminar vinilo (admin)   |

---

### 📦 Proveedores

| Método | Ruta                  | Descripción               |
| ------ | --------------------- | ------------------------- |
| GET    | /api/proveedores      | Listar todos (admin)      |
| POST   | /api/proveedores      | Crear proveedor (admin)   |
| GET    | /api/proveedores/{id} | Obtener proveedor (admin) |
| PUT    | /api/proveedores/{id} | Actualizar proveedor      |
| DELETE | /api/proveedores/{id} | Eliminar proveedor        |

---

### 👤 Usuarios

| Método | Ruta               | Descripción             |
| ------ | ------------------ | ----------------------- |
| GET    | /api/usuarios      | Listar todos (admin)    |
| POST   | /api/usuarios      | Crear usuario (admin)   |
| GET    | /api/usuarios/{id} | Obtener usuario (admin) |
| PUT    | /api/usuarios/{id} | Actualizar usuario      |
| DELETE | /api/usuarios/{id} | Eliminar usuario        |

---

### 📍 Direcciones de Envío

| Método | Ruta                        | Descripción                    |
| ------ | --------------------------- | ------------------------------ |
| GET    | /api/direcciones-envio      | Listar direcciones del usuario |
| POST   | /api/direcciones-envio      | Crear dirección de envío       |
| GET    | /api/direcciones-envio/{id} | Obtener dirección específica   |
| PUT    | /api/direcciones-envio/{id} | Actualizar dirección           |
| DELETE | /api/direcciones-envio/{id} | Eliminar dirección             |

---

### 🛒 Pedidos

| Método | Ruta              | Descripción               |
| ------ | ----------------- | ------------------------- |
| GET    | /api/pedidos      | Listar pedidos            |
| POST   | /api/pedidos      | Crear pedido              |
| GET    | /api/pedidos/{id} | Obtener pedido            |
| PUT    | /api/pedidos/{id} | Actualizar pedido (admin) |
| DELETE | /api/pedidos/{id} | Eliminar pedido (admin)   |

---

### 📑 Detalles de Pedido

| Método | Ruta                      | Descripción                |
| ------ | ------------------------- | -------------------------- |
| GET    | /api/detalles-pedido      | Listar detalles de pedidos |
| POST   | /api/detalles-pedido      | Crear detalle de pedido    |
| GET    | /api/detalles-pedido/{id} | Obtener detalle específico |
| PUT    | /api/detalles-pedido/{id} | Actualizar detalle         |
| DELETE | /api/detalles-pedido/{id} | Eliminar detalle           |

---

### ⭐ Valoraciones

| Método | Ruta                   | Descripción                   |
| ------ | ---------------------- | ----------------------------- |
| GET    | /api/valoraciones      | Listar valoraciones           |
| POST   | /api/valoraciones      | Crear valoración              |
| GET    | /api/valoraciones/{id} | Obtener valoración específica |
| PUT    | /api/valoraciones/{id} | Actualizar valoración         |
| DELETE | /api/valoraciones/{id} | Eliminar valoración           |

---

## 🛠 Cómo probar los endpoints

Puedes usar herramientas como **Postman** o `curl`.

### Ejemplo de login:

```bash
curl -X POST http://localhost:8000/api/login \
-H "Content-Type: application/json" \
-d '{
    "email": "admin@example.com",
    "password": "password"
}'
```

### Usar el token recibido:

```bash
curl -X GET http://localhost:8000/api/proveedores \
-H "Authorization: Bearer <token>"
```

---

## 🚀 Notas técnicas

* Usa **Laravel Sanctum** para autenticación por token.
* Los endpoints de admin están protegidos por el middleware `is_admin`.
* Las relaciones en las migraciones están configuradas con `onDelete('cascade')` donde corresponde.

---

**¡Proyecto desarrollado con ❤️ por Adrian Montes Bastida!**
