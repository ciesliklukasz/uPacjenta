##Run Project
* **docker-compose up -d**
* **docker-compose exec app php artisan migrate:fresh**
* **docker-compose exec app php artisan db:seed**

##Endpoints
1. ###Laboratory Examination:
    * **GET - /laboratory_examinations/{id}** - Get single
    * **GET - /laboratory_examinations/from_category/{id}** - All from category
    * **POST - /laboratory_examinations/create** - Create new one. Example body: **{"category_id": 1, "name": "Test"}**
    * **PUT - /laboratory_examinations/update** - Update new one. Example body: **{"name": "Test"}**
    * **DELETE - /laboratory_examinations/delete/{id}** - Delete new one.
2. ###Laboratory Examination category:
    * **GET - /laboratory_examinations_category/{id}** - Get single
    * **POST - /laboratory_examinations_category/create** - Create new one. Example body: **{"name": "Test"}**
    * **PUT - /laboratory_examinations_category/update** - Update new one. Example body: **{"name": "Test"}**
    * **DELETE - /laboratory_examinations_category/delete/{id}** - Delete new one.


