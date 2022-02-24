# Web Service Product

Web Service Product adalah sebuah sistem web service, di mana user dapat menambah dan menghapus product

## Installation

Clone git [Gitlab](https://github.com/naufalols/widya-test-web-service.git) untuk menginstall aplikasi.

```bash
git clone https://gitlab.com/naufalols/electricWallet.git
```
buat satu database msql pada server, lalu buat satu file .env atau rename .env.example dan koneksikan database yang telah dibuat.

Lalu di dalam bash lakukan

```bash
# composer
composer install

# migrate table
php artisan migrate

# seeding table
php artisan db:seed

# key generate
php artisan key:generate

# run server
php artisan serve
```
## Usage

Dalam web service ini memiliki 4 endpoint

Buka database lalu buka table users kemudian pilih salah satu users
### 1. Login
endpoint http://base_url/api/login

Method : POST
```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8001/api/login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'email=naufal%40naufal.com&password=password',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: XSRF-TOKEN=eyJpdiI6Ilo0b3F5ZEFrVXdOK1V3M2RqSHBqWHc9PSIsInZhbHVlIjoicEV2Si9EVGw0NGd5UW5pK21XK09wSFg1bWkwUEhNcEExZGpBMFlFeDNub05oQWFyVVlncmZRTjEwWHp6clI3MVk5b0p1MnRoQTNrMDB2ZTFHNnZOL3JFamtZNm5JMFN1Wlg0ZXZ1anp4eVhaNi9QeFFLZWwyQmtJaS9MTUowK2MiLCJtYWMiOiIxODJlNzZlNzI5ZjZiNjA3OGZlOTg3YzRjNWQwYzMwMjBmOTRhZTc3OGJhODc0ODFmNWYxMzkwMGM3ZDMwNjVmIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjBJeTdzaVU5RWJoMFJLWis5d1h2WlE9PSIsInZhbHVlIjoiSXZZMFp3MFMwcGVLb3ZPZVl6Rk9ab1MvTzZrVFFvemhvdDZKdC9IUVNORGNCRG1EUnNLTlg2V0EyRjFlWnlYNm9xUWo1VHNGUjRiU3Z4RWdDYmViM2R6TmhYMVFqbFRvR3JUOWJveDIwbHdUTmFaOVpuQkJnaEtlT2wxZTRRQjIiLCJtYWMiOiI0YmM1MDBmZWQ1ZDUwOWRlYzhiNmEyZGM5NjYwZmUwOTEzZjAwMjRkNWYxMDJlNjU0YWQ3Y2JkMGUyODA5OTZiIiwidGFnIjoiIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

```
response dari endpoint ini adalah
```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMVwvYXBpXC9sb2dpbiIsImlhdCI6MTY0NTY3MDY4MiwiZXhwIjoxNjQ1Njc0MjgyLCJuYmYiOjE2NDU2NzA2ODIsImp0aSI6ImhEcUV2eWVvNWRieFJ2OVciLCJzdWIiOjExLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.OsaFkkECcK62JuQD04CcrGT2oYssysguNO_0rQKRPes",
    "token_type": "bearer",
    "expires_in": 3600
}
```
copy bearer token dari json access_token untuk digunakan mengakses endpoint lainnya

### 2. User Profile
endpoint http://base_url/api/profiles

Method : GET
Authorization : Bearer dan masukkan JWT Token
```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://base_urlapi/profiles',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMVwvYXBpXC9sb2dpbiIsImlhdCI6MTY0NTY2OTY1NCwiZXhwIjoxNjQ1NjczMjU0LCJuYmYiOjE2NDU2Njk2NTQsImp0aSI6IndKQWdJaHJrM3hsVThkZlQiLCJzdWIiOjExLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.fTcul_zu20sH6ZaBxz39vRxIl-nBtJzobeQNXbudZgs',
    'Cookie: XSRF-TOKEN=eyJpdiI6IktiaTc1U2NKd04yc1VsTElaby9PR3c9PSIsInZhbHVlIjoiYkowemNaYlR3bEhrRzFZMDNuWE96dTdSSGZwOG91bld1UTlXS2NKVmgzZzZBTEdqeFJRQm1McjBTQTJYUGlsL0JudkMxbDZOK3dISGdFd2owcEtOUUFoVVMydHA1RUo3K2hGZUhwZjJ6TEZ6dUJ5d3F6ZjBYRzZLZzdqdWJMS1kiLCJtYWMiOiJhMTE3NTk0ZjdhNGFiZDdhODJiM2U2MmM1ZWE0OGM5NTI1YWU2MjJkZWRhZTdjMjFhMDQxNDdjZjFkOWY5OWFhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Im1zVTFFMFpvL3ErdXVuQVh6L0JFUWc9PSIsInZhbHVlIjoiazZWeUJ1bFQrZWxKQkpUMk1VelBhdWpaaU5yNTE0VnBtRU8rSDJhZ0tRd0tjTkN3dlI1b2ppMmtqRE91akNtSEpKcVk2UkNJV3Q2aE1ob1lBbFJFQkdyVlRUQlNIZkU4UWpDZjJrajR1Q0kycTQvY2JOWGl0SjJXZG5aV296clAiLCJtYWMiOiJiMmQzYzRlYWI1YmNlYzc5YmZmN2ZiOWE1ZWFmNzE4OGUwYmE4MmJmODJmODk1Y2FmOWZiN2JkZWU4ZDJkOWFiIiwidGFnIjoiIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


```
response dari endpoint ini adalah
```json
{
    "status": 200,
    "message": "Success",
    "data": {
        "id": 11,
        "name": "Muhammad Naufal",
        "email": "naufal@naufal.com",
        "email_verified_at": null,
        "created_at": "2021-12-05T13:56:28.000000Z",
        "updated_at": "2021-12-05T13:56:28.000000Z"
    }
}
```

### 3. Lihat Product
endpoint http://base_url/api/product

Method : GET
Authorization : Bearer dan masukkan JWT Token

```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8001/api/product/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMVwvYXBpXC9sb2dpbiIsImlhdCI6MTY0NTY2OTY1NCwiZXhwIjoxNjQ1NjczMjU0LCJuYmYiOjE2NDU2Njk2NTQsImp0aSI6IndKQWdJaHJrM3hsVThkZlQiLCJzdWIiOjExLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.fTcul_zu20sH6ZaBxz39vRxIl-nBtJzobeQNXbudZgs',
    'Cookie: XSRF-TOKEN=eyJpdiI6IktiaTc1U2NKd04yc1VsTElaby9PR3c9PSIsInZhbHVlIjoiYkowemNaYlR3bEhrRzFZMDNuWE96dTdSSGZwOG91bld1UTlXS2NKVmgzZzZBTEdqeFJRQm1McjBTQTJYUGlsL0JudkMxbDZOK3dISGdFd2owcEtOUUFoVVMydHA1RUo3K2hGZUhwZjJ6TEZ6dUJ5d3F6ZjBYRzZLZzdqdWJMS1kiLCJtYWMiOiJhMTE3NTk0ZjdhNGFiZDdhODJiM2U2MmM1ZWE0OGM5NTI1YWU2MjJkZWRhZTdjMjFhMDQxNDdjZjFkOWY5OWFhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Im1zVTFFMFpvL3ErdXVuQVh6L0JFUWc9PSIsInZhbHVlIjoiazZWeUJ1bFQrZWxKQkpUMk1VelBhdWpaaU5yNTE0VnBtRU8rSDJhZ0tRd0tjTkN3dlI1b2ppMmtqRE91akNtSEpKcVk2UkNJV3Q2aE1ob1lBbFJFQkdyVlRUQlNIZkU4UWpDZjJrajR1Q0kycTQvY2JOWGl0SjJXZG5aV296clAiLCJtYWMiOiJiMmQzYzRlYWI1YmNlYzc5YmZmN2ZiOWE1ZWFmNzE4OGUwYmE4MmJmODJmODk1Y2FmOWZiN2JkZWU4ZDJkOWFiIiwidGFnIjoiIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


```
hasil dari endpoint ini adalah
```json
{
    "status": 200,
    "message": "Success",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "product_name": "Soto Ayam",
                "product_price": "76000.00",
                "product_qty": 48,
                "created_at": "2021-12-05T13:49:24.000000Z",
                "updated_at": "2021-12-05T13:49:24.000000Z"
            },
            {
                "id": 4,
                "product_name": "Nasi Pecel",
                "product_price": "64797.00",
                "product_qty": 19,
                "created_at": "2021-12-05T13:49:24.000000Z",
                "updated_at": "2021-12-05T13:49:24.000000Z"
            },
            {
                "id": 7,
                "product_name": "Sate Lilit",
                "product_price": "76916.00",
                "product_qty": 35,
                "created_at": "2021-12-05T13:49:24.000000Z",
                "updated_at": "2021-12-05T13:49:24.000000Z"
            },
            {
                "id": 8,
                "product_name": "Nasi Timbel",
                "product_price": "72743.00",
                "product_qty": 24,
                "created_at": "2021-12-05T13:49:24.000000Z",
                "updated_at": "2021-12-05T13:49:24.000000Z"
            },
            {
                "id": 9,
                "product_name": "Pisang Molen",
                "product_price": "96839.00",
                "product_qty": 72,
                "created_at": "2021-12-05T13:49:24.000000Z",
                "updated_at": "2021-12-05T13:49:24.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8001/api/product?page=1",
        "from": 1,
        "last_page": 2,
        "last_page_url": "http://127.0.0.1:8001/api/product?page=2",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8001/api/product?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8001/api/product?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8001/api/product?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": "http://127.0.0.1:8001/api/product?page=2",
        "path": "http://127.0.0.1:8001/api/product",
        "per_page": 5,
        "prev_page_url": null,
        "to": 5,
        "total": 9
    }
}
```
### 3. Tambah Product
endpoint http://base_url/api/product

Method : POST
Authorization : Bearer dan masukkan JWT Token
Body : 
    product_name:
    product_price:
    product_qty:
    

```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'base_url/api/product',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('product_name' => 'Martabak Asia','product_price' => '1001','product_qty' => '22'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMVwvYXBpXC9sb2dpbiIsImlhdCI6MTY0NTY2OTY1NCwiZXhwIjoxNjQ1NjczMjU0LCJuYmYiOjE2NDU2Njk2NTQsImp0aSI6IndKQWdJaHJrM3hsVThkZlQiLCJzdWIiOjExLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.fTcul_zu20sH6ZaBxz39vRxIl-nBtJzobeQNXbudZgs',
    'Cookie: XSRF-TOKEN=eyJpdiI6IktiaTc1U2NKd04yc1VsTElaby9PR3c9PSIsInZhbHVlIjoiYkowemNaYlR3bEhrRzFZMDNuWE96dTdSSGZwOG91bld1UTlXS2NKVmgzZzZBTEdqeFJRQm1McjBTQTJYUGlsL0JudkMxbDZOK3dISGdFd2owcEtOUUFoVVMydHA1RUo3K2hGZUhwZjJ6TEZ6dUJ5d3F6ZjBYRzZLZzdqdWJMS1kiLCJtYWMiOiJhMTE3NTk0ZjdhNGFiZDdhODJiM2U2MmM1ZWE0OGM5NTI1YWU2MjJkZWRhZTdjMjFhMDQxNDdjZjFkOWY5OWFhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Im1zVTFFMFpvL3ErdXVuQVh6L0JFUWc9PSIsInZhbHVlIjoiazZWeUJ1bFQrZWxKQkpUMk1VelBhdWpaaU5yNTE0VnBtRU8rSDJhZ0tRd0tjTkN3dlI1b2ppMmtqRE91akNtSEpKcVk2UkNJV3Q2aE1ob1lBbFJFQkdyVlRUQlNIZkU4UWpDZjJrajR1Q0kycTQvY2JOWGl0SjJXZG5aV296clAiLCJtYWMiOiJiMmQzYzRlYWI1YmNlYzc5YmZmN2ZiOWE1ZWFmNzE4OGUwYmE4MmJmODJmODk1Y2FmOWZiN2JkZWU4ZDJkOWFiIiwidGFnIjoiIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


```
hasil dari endpoint ini adalah
```json
{
    "status": 201,
    "error": 0,
    "message": "Product Created"
}
```

### 5. Hapus Product
endpoint http://base_url/api/product/(id) masukkan id product yang akan dihapus

Method : DELETE
Authorization : Bearer dan masukkan JWT Token

    

```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8001/api/product/12',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMVwvYXBpXC9sb2dpbiIsImlhdCI6MTY0NTY2OTY1NCwiZXhwIjoxNjQ1NjczMjU0LCJuYmYiOjE2NDU2Njk2NTQsImp0aSI6IndKQWdJaHJrM3hsVThkZlQiLCJzdWIiOjExLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.fTcul_zu20sH6ZaBxz39vRxIl-nBtJzobeQNXbudZgs',
    'Cookie: XSRF-TOKEN=eyJpdiI6IktiaTc1U2NKd04yc1VsTElaby9PR3c9PSIsInZhbHVlIjoiYkowemNaYlR3bEhrRzFZMDNuWE96dTdSSGZwOG91bld1UTlXS2NKVmgzZzZBTEdqeFJRQm1McjBTQTJYUGlsL0JudkMxbDZOK3dISGdFd2owcEtOUUFoVVMydHA1RUo3K2hGZUhwZjJ6TEZ6dUJ5d3F6ZjBYRzZLZzdqdWJMS1kiLCJtYWMiOiJhMTE3NTk0ZjdhNGFiZDdhODJiM2U2MmM1ZWE0OGM5NTI1YWU2MjJkZWRhZTdjMjFhMDQxNDdjZjFkOWY5OWFhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Im1zVTFFMFpvL3ErdXVuQVh6L0JFUWc9PSIsInZhbHVlIjoiazZWeUJ1bFQrZWxKQkpUMk1VelBhdWpaaU5yNTE0VnBtRU8rSDJhZ0tRd0tjTkN3dlI1b2ppMmtqRE91akNtSEpKcVk2UkNJV3Q2aE1ob1lBbFJFQkdyVlRUQlNIZkU4UWpDZjJrajR1Q0kycTQvY2JOWGl0SjJXZG5aV296clAiLCJtYWMiOiJiMmQzYzRlYWI1YmNlYzc5YmZmN2ZiOWE1ZWFmNzE4OGUwYmE4MmJmODJmODk1Y2FmOWZiN2JkZWU4ZDJkOWFiIiwidGFnIjoiIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


```
hasil dari endpoint ini adalah
```json
{
    "status": 202,
    "error": 0,
    "message": "Product Successfully deleted"
}
```
### 5. Logout
endpoint http://base_url/api/logout
```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8001/api/logout',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'email=naufal%40naufal.com&password=password',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMVwvYXBpXC9sb2dpbiIsImlhdCI6MTY0NTY2OTY1NCwiZXhwIjoxNjQ1NjczMjU0LCJuYmYiOjE2NDU2Njk2NTQsImp0aSI6IndKQWdJaHJrM3hsVThkZlQiLCJzdWIiOjExLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.fTcul_zu20sH6ZaBxz39vRxIl-nBtJzobeQNXbudZgs',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: XSRF-TOKEN=eyJpdiI6IktiaTc1U2NKd04yc1VsTElaby9PR3c9PSIsInZhbHVlIjoiYkowemNaYlR3bEhrRzFZMDNuWE96dTdSSGZwOG91bld1UTlXS2NKVmgzZzZBTEdqeFJRQm1McjBTQTJYUGlsL0JudkMxbDZOK3dISGdFd2owcEtOUUFoVVMydHA1RUo3K2hGZUhwZjJ6TEZ6dUJ5d3F6ZjBYRzZLZzdqdWJMS1kiLCJtYWMiOiJhMTE3NTk0ZjdhNGFiZDdhODJiM2U2MmM1ZWE0OGM5NTI1YWU2MjJkZWRhZTdjMjFhMDQxNDdjZjFkOWY5OWFhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Im1zVTFFMFpvL3ErdXVuQVh6L0JFUWc9PSIsInZhbHVlIjoiazZWeUJ1bFQrZWxKQkpUMk1VelBhdWpaaU5yNTE0VnBtRU8rSDJhZ0tRd0tjTkN3dlI1b2ppMmtqRE91akNtSEpKcVk2UkNJV3Q2aE1ob1lBbFJFQkdyVlRUQlNIZkU4UWpDZjJrajR1Q0kycTQvY2JOWGl0SjJXZG5aV296clAiLCJtYWMiOiJiMmQzYzRlYWI1YmNlYzc5YmZmN2ZiOWE1ZWFmNzE4OGUwYmE4MmJmODJmODk1Y2FmOWZiN2JkZWU4ZDJkOWFiIiwidGFnIjoiIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


```
hasil dari response ini adalah
```json
{
    "message": "User successfully logged out."
}
```
## Last but not Least
Terima kasih untuk Widya telah memberi saya kesempatan untuk melakukan pretest, semoga pretest ini dapat menunjang keputusan yang baik untuk saya maupun pihak Privy.id

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
