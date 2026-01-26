<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-admin-user
                            {--name= : User name}
                            {--email= : User email}
                            {--password= : User password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update an admin user (master)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = (string) ($this->option('name') ?: $this->ask('Name'));
        $email = (string) ($this->option('email') ?: $this->ask('Email'));
        $password = (string) ($this->option('password') ?: $this->secret('Password'));

        if ($name === '' || $email === '' || $password === '') {
            $this->error('Name, email and password are required.');
            return self::FAILURE;
        }

        $user = User::query()->firstOrNew(['email' => $email]);
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->save();

        $this->info('Admin user saved.');
        $this->line('Email: '.$user->email);
        $this->line('Name: '.$user->name);

        return self::SUCCESS;
    }
}
