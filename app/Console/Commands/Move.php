<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Transaction;

class Move extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'move {sender} {recipient} {amount} {description?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Перевод денег от пользователя к пользователю';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (is_int($this->argument('sender')))
            $sender = User::find($this->argument('sender'));
        else
            $sender = User::where('name', $this->argument('sender'))->first();

        if (is_int($this->argument('recipient')))
            $recipient =User::find($this->argument('recipient'));
        else
            $recipient = User::where('name', $this->argument('recipient'))->first();

        $amount = (float)$this->argument('amount'); // исправил на float - разделитель дробной части .
        $description = $this->argument('description') ?? '';

        if (!$sender)
            throw new \Exception('Нет пользователя отправителя');

        if (!$recipient)
            throw new \Exception('Нет пользователя получателя');

        $this->check($sender, $amount);

        $transaction = new Transaction([
            'user_id_sender'    => $sender->id,
            'user_id_recipient' => $recipient->id,
            'amount'            => $amount,
            'description'       => $description,
            'type' => 'console',
            'user_id' => User::where('name','console')->first()->id,
        ]);

        $transaction->save();

        // Уменьшаем баланс у отправителя
        $sender->update(['balance' => ($sender->balance - $amount)]);
        $sender->save();

        // Увеличиваем баланс у получателя
        $recipient->update(['balance' => ($recipient->balance + $amount)]);
        $recipient->save();
    }

    /**
     * Проверка на возможность проведения транзакции (проверка баланса счета пользователя)
     * @param $user
     * @param $amount
     * @return bool
     * @throws \Exception
     */
    public function check($user, $amount)
    {
        if ($user->balance < $amount)
            throw new \Exception("У пользователя {$user->name} недостаточно денег на балансе!");
        else
            return true;
    }

}
