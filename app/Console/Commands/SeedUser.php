<?php


namespace App\Console\Commands;


use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeedUser extends Command
{
    protected $signature = 'seed:user {--email=} {--name=} {--password=}';

    public function handle()
    {
        $email = $this->option('email');
        $name = $this->option('name');
        $password = $this->option('password');

        /** @var User $user */
        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $user->api_token = Str::random(64);
        $user->password = bcrypt($password);

        $user->save();
    }
}
