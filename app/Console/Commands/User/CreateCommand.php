<?php

namespace App\Console\Commands\User;

use App\Models\User;
use DomainException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateCommand extends Command
{
    protected $signature = 'user:create';

    protected $description = 'This command will help you create a user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $input['name'] = $this->ask('Set name', 'Name-'.now()->timestamp);
        $input['email'] = $this->askEmail();
        $input['password'] = $this->askPassword();
        $input['is_admin'] = $this->askIsAdmin();

        try {
            $user = User::create($input);
        } catch (DomainException $e) {
            $this->error($e->getMessage());
            return 1;
        }

        $role = $user->is_admin ? 'administrator' : 'user';

        $this->info('The user was successfully created with the following credentials:');
        $this->info("Name: $user->name");
        $this->info("Email: $user->email");
        $this->info("As: $role");

        return 0;
    }

    private function askEmail()
    {
        $email = $this->ask('Set email');

        if (User::where('email', $email)->first()) {
            $this->error("The email $email in the system is already taken");
            $this->askEmail();
        }

        if (empty($email)) {
            $this->error("Email cannot be empty!");
            $this->askEmail();
        }

        return $email;
    }

    private function askPassword(): string
    {
        $password = $this->secret('Set password. Remember your password! (minimum 8 characters)');
        $length = Str::length($password);

        if ($length < 8) {
            $this->error('Password must not be less than 8 characters');
            $this->askPassword();
        }

        return Hash::make($password);
    }

    private function askIsAdmin(): bool
    {
        $is_admin = $this->ask('Administrator user?\n[Yes/no]', false);

        if ($is_admin === false) {
            return false;
        } elseif ($is_admin === 'no') {
            return false;
        } elseif ($is_admin === 'Yes') {
            return true;
        } else {
            $this->warn('The answer should only be `Yes` or `no`');
            $this->askIsAdmin();
        }

        return false;
    }
}
