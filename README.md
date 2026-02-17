# Backend Test Laravel API

## Cara Install
1. composer install
2. copy .env.example .env
3. php artisan key:generate
4. set database di .env
5. import database.sql
6. php artisan serve

## Endpoint

POST /api/login
GET /api/users
POST /api/users
GET /api/users/{id}
PUT /api/users/{id}
DELETE /api/users/{id}

GET /api/search/name
GET /api/search/nim
GET /api/search/ymd

## Auth
Gunakan Bearer Token dari login 
