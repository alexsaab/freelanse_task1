<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создаем админа
        $user = new User(
            [
                'name'  => 'admin',
                'email'     => 'admin@mydomain.ru',
                'password'  => bcrypt('secret'),
                'firstname' => 'Администратор',
                'lastname'  => 'Системы',
                'balance'   => 0,
                'role'      => 'admin',
            ]
        );
        $user->save();
        $this->command->info('Пользователь admin создан');

        $user = new User(
            [
                'name'  => 'console',
                'email'     => 'console@mydomain.ru',
                'password'  => bcrypt('secret'),
                'firstname' => 'Консоль',
                'lastname'  => 'Системы',
                'balance'   => 0,
                'role'      => 'admin',
            ]
        );
        $user->save();
        $this->command->info('Пользователь console создан');


        $user = new User(
            [
                'name'  => 'serg',
                'email'     => 'serg@mydomain.ru',
                'password'  => bcrypt('secret'),
                'firstname' => 'Сергей',
                'lastname'  => 'Иванов',
                'balance'   => 5000,
                'role'      => 'client',
            ]
        );
        $user->save();
        $this->command->info('Пользователь serg создан');

        $user = new User(
            [
                'name'  => 'mike',
                'email'     => 'mike@mydomain.ru',
                'password'  => bcrypt('secret'),
                'firstname' => 'Михаил',
                'lastname'  => 'Петров',
                'balance'   => 2000,
                'role'      => 'client',
            ]
        );
        $user->save();
        $this->command->info('Пользователь mike создан');

        $user = new User(
            [
                'name'  => 'leo',
                'email'     => 'leo@mydomain.ru',
                'password'  => bcrypt('secret'),
                'firstname' => 'Леонид',
                'lastname'  => 'Краснов',
                'balance'   => 2000,
                'role'      => 'client',
            ]
        );
        $user->save();
        $this->command->info('Пользователь leo создан');

    }
}
