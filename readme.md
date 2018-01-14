## Описание задания

ороче есть таблица БД
CREATE TABLE `users` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
`balance` decimal(10,2) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

Используя таблицу users, реализовать перечисление денежных средств с баланса одного
пользователя на баланс другого. 
Операция перечисления должна запускаться из командной
строки, веб-интерфейс не требуется. 
Реализовать проверки на допустимость операций
перевода. Одновременно исполняемые операции перевода не должны нарушать
целостность данных.
К задаче приложить описание, в котором сказано, как подготовить приложение к работе и
как выполнить операцию.

##Этапы выполнения 

1. Заходим в phpMyAdmin и создаем новую базу с пользователем freelance_task1, база соответсвенно и пароль freelance_task1 / freelance_task1 

2. Делаем нужные каталоги на сервере Linux /var/www/freelance/task1 и выставляем нужные права командой "sudo chmod 0777 -R /var/www/freelance/task1" 

3. Запускаем PhpStorm и стартуем в нем новый composer проект laravel/laravel 

4. Начинаем редактировать и весьти постоянные записи в данный файл readme.md

5. Правим файл в центральной директории Laravel .env выставляем нем: 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=freelance_task1
DB_USERNAME=freelance_task1
DB_PASSWORD=freelance_task1

это все по нашей базе как раз. 

6. В установленной версии Laravel в директории database/migrations находим два файла 

2014_10_12_000000_create_users_table.php
2014_10_12_100000_create_password_resets_table.php

Это файлы миграции в базу данных, которые идус с Laravel по умолчанию, один с пользователями, другой для сброса паролей пользователей. Начинаем править файл 2014_10_12_000000_create_users_table.php именно он содержит информацию о пользователях.

В итоге что у нас получилось: 
...
public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('Имя пользователя, тоже уникальное');
            $table->string('email')->unique()->comment('Email');
            $table->string('password')->comment('Пароль');
            $table->string('firstname')->index()->comment('Имя пользотеля, именно как зовут');
            $table->string('lastname')->index()->comment('Фамилия пользователя');
            $table->decimal('balance', 10, 2)->comment('Храним тут баланс, хотя конечно это и неправильно');
            $table->string('role')->index()->comment('Роль пользователя, тоже неправильно хранить в одной таблице, но раз уж начали...');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    ...
     
7. Запускаем миграцию командой в консоле "php artisan migrate"
В результате у нас получится: 

Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table

8. Создаем таблицу, которая будет содержать транзакции: 

php artisan make:model Transaction --all

При этом у нас сразу сгенирируется модель, миграция и контроллер 

9. Правим файл database/migrations/2018_01_14_042942_create_transactions_table.php
это миграция для таблицы содержайщей информацию о транзакциях 

10.Исправляем описания моделей, файлы: 

Transaction.php
User.php


 

##Замечания по работе

1. Правильнее сделать не одну таблицу user, в которой хранить одновременно баланс и пользователей, а несколько одна для храненя пользователей, вторая для хранения ТЗ, но так как у нас в ТЗ так отмечено, делаем все строго по ТЗ. 

2. Php версии должен быть не менее 7, так как Laravel/Laravel а сейчас он версии 5.5 работает с php версии не ниже 7.0. Иначе composer его не поставит. 



 