<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {--email=admin@ecotrack.test : Email for admin} {--password=password : Password for admin}';
    protected $description = 'Create an admin user account';

    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');

        $exists = User::where('email', $email)->exists();

        if ($exists) {
            $this->warn("User with email '{$email}' already exists.");
            if (!$this->confirm('Do you want to update this user to admin role?')) {
                return Command::FAILURE;
            }
            $user = User::where('email', $email)->first();
            $user->update([
                'role' => 'admin',
                'password' => $password,
            ]);
            $this->info("User '{$email}' has been updated to admin role.");
            return Command::SUCCESS;
        }

        User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => $password,
            'role' => 'admin',
        ]);

        $this->info("Admin user created successfully!");
        $this->table(
            ['Field', 'Value'],
            [
                ['Name', 'Admin'],
                ['Email', $email],
                ['Password', $password],
                ['Role', 'admin'],
            ]
        );

        return Command::SUCCESS;
    }
}
