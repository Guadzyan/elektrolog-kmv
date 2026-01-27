<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class AdminLockdown extends Command
{
    protected $signature = 'admin:lockdown {--delete-users : Also delete all users}';

    protected $description = 'Revoke all Sanctum tokens and optionally delete all users (admin lockdown)';

    public function handle(): int
    {
        $tokens = PersonalAccessToken::query()->delete();
        $this->info('Revoked tokens: ' . (string) $tokens);

        if ($this->option('delete-users')) {
            $deleted = User::query()->delete();
            $this->info('Deleted users: ' . (string) $deleted);
        }

        return self::SUCCESS;
    }
}
