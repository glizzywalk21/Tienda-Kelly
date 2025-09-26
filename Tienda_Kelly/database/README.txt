Paquete de migraciones: de multi-mercado a único mercado con ÁREAS
Fecha: 2025-09-23

Contenido (database/migrations):
  - 2025_09_23_000001_create_areas_table.php
  - 2025_09_23_000010_rename_markets_table_to_areas.php
  - 2025_09_23_000020_switch_vendors_to_area_id.php
  - 2025_09_23_000030_products_to_area_or_vendor.php
  - 2025_09_23_000040_alter_carts_drop_market_add_area.php

Uso rápido (SIN datos que conservar):
  1) php artisan migrate:reset
  2) Copia la carpeta database/migrations de este paquete sobre tu proyecto
  3) php artisan migrate

Uso con DATOS existentes (transformación):
  1) Asegura respaldo de tu BD
  2) Ejecuta las migraciones en orden (Laravel ya ordena por timestamp):
     php artisan migrate
  3) Verifica:
     - vendors.area_id existe y es UNIQUE (un vendedor por área)
     - products tiene vendor_id (ideal) o area_id (alternativa)
     - carts/reservations no referencian market_id; si lo hacían, ahora usan area_id

Notas:
  - Estas migraciones son generales y manejan nombres de tablas comunes
    (markets/mercados/mercado_local(es), vendors/vendedores, products/productos).
  - Si cambias nombres, ajústalos a tu esquema.
  - Para modificar columnas con NOT NULL / rename en otros motores, puede ser útil:
    composer require doctrine/dbal
