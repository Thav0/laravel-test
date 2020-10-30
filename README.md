<p>Especificações do teste:</p>

- Estrutura de login e cadastro para Vendedor e Comprador. (Usando JWT)
- CRUD de produtos.
- Compra de produtos. (Comprador)
- Minhas vendas. (Vendedor)


### **Como rodar o teste**

## Server

```
composer install

Criar DB no Mysql com o mesmo nome do .env.example

php artisan migrate

php artisan db:seed

```

## Rotas
cd /web

```
POST /auth/login
POST /auth/register
GET  /auth/register

DELETE /api/products/1
PUT /api/products/1
GET /api/products/1
POST /api/products
GET /api/products

GET /api/orders
POST /api/orders

```
