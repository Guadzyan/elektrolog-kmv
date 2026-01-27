<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:lockdown {--delete-users : Also delete all users}', function () {
    $tokens = PersonalAccessToken::query()->delete();
    $this->info('Revoked tokens: ' . (string) $tokens);

    if ((bool) $this->option('delete-users')) {
        $deleted = User::query()->delete();
        $this->info('Deleted users: ' . (string) $deleted);
    }
})->purpose('Revoke all Sanctum tokens and optionally delete all users');

Artisan::command('app:make-admin-user {--name= : User name} {--email= : User email} {--password= : User password}', function () {
    $name = (string) ($this->option('name') ?: $this->ask('Name'));
    $email = (string) ($this->option('email') ?: $this->ask('Email'));
    $password = (string) ($this->option('password') ?: $this->secret('Password'));

    if ($name === '' || $email === '' || $password === '') {
        $this->error('Name, email and password are required.');
        return;
    }

    $user = User::query()->firstOrNew(['email' => $email]);
    $user->name = $name;
    $user->password = Hash::make($password);
    $user->save();

    $this->info('Admin user saved.');
    $this->line('Email: ' . $user->email);
    $this->line('Name: ' . $user->name);
})->purpose('Create or update an admin user (master)');
