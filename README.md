# Setup

### Laravel

From project folder run:

    composer install

Open `composer.json` and run all 4 scripts at the end of that file.

Create database, then open .env file and fill its info there:

    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=


For testing: PHPUnit uses different database `testing` but you can modify it in phpunit.xml file:

    <server name="DB_DATABASE" value="testing"/>

Then run migrations with the `--seed` flag to have some products in your table:

    php artisan migrate --seed

Start the development server and ensure it's running on port 8000:

    php artisan serve

### Postman

Now it's possible to test API with Postman (or another application).

In order to use already prepared queries, you can import `CRUD API with Sanctum.postman_collection.json` from the root folder.

Remember, that after the registration or login you will receive **bearer token** which must be then filled in
*Authorization* tab of ICT collection or each query.

If you choose to write the queries yourself, then here are all routes and query formats:

##### POST /api/auth/register

    {
        "name": "Bill Gates",
        "email": "bill.gates@microsoft.com",
        "password": "aaaaa",
        "password_confirmation": "aaaaa"
    }

##### POST /api/auth/login

    {
        "email": "bill.gates@microsoft.com",
        "password": "aaaaa"
    }

##### GET /api/me

##### POST /api/auth/logout

##### POST /api/products

    {
        "name": "Milk",
        "description": "Skimmed milk",
        "attributes": [
            {
                "key": "Fat contents",
                "value": "0.5%"
            },
            {
                "key": "Volume",
                "value": "1L"
            }
        ]
    }

##### GET /api/products/:id

##### GET /api/products

##### PUT /api/products/:id

    {
        "name": "Milk",
        "description": "Fatty milk",
        "attributes": [
            {
                "key": "Fat contents",
                "value": "3.5%"
            },
            {
                "key": "Volume",
                "value": "0.5L"
            },
            {
                "key": "Tasty",
                "value": "Yes"
            }
        ]
    }

##### DELETE /api/products/:id

### Sample front-end application

To make things even more simple, a sample front-end app is provided!

Open a new terminal and navigate to `vue` folder:

    cd vue

From there start the php server on **different** port than 8000:

    php -S localhost:8080

Please, note that Laravel back-end server should run **on the same host and port should be 8000** !

Then open `http://localhost:8080` in your browser.