<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetUserRole extends Command
{
    protected $signature = 'user:role {email} {role}';
    protected $description = 'Назначить роль пользователю (admin, manager, warehouse)';

    public function handle(): int
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        if (!in_array($role, ['admin', 'manager', 'warehouse'])) {
            $this->error("Роль должна быть: admin, manager или warehouse");
            return 1;
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Пользователь с email {$email} не найден");
            return 1;
        }

        $user->update(['role' => $role]);

        $this->info("Пользователю {$user->name} ({$email}) назначена роль: {$role}");
        return 0;
    }
}
