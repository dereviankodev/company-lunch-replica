<?php

namespace App\Console\Commands\User;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $input['name'] = $this->ask('Set full name', 'Name-'.now()->timestamp);
        $input['email'] = $this->askEmail();
        $input['password'] = $this->askPassword();
        $input['is_admin'] = $this->askIsAdmin();

        $validate = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|min:8|max:255',
            'is_admin' => 'required|boolean'
        ]);

        if (!$validate->passes()) {
            foreach ($validate->messages()->all() as $message) {
                $this->error($message);
            }

            return 1;
        }

        try {
            $user = User::create($validate->validate());
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }

        $role = $user->is_admin ? 'administrator' : 'user';

        $this->warn('The user was successfully created with the following credentials:');
        $this->info("Full name: $user->name");
        $this->info("Email: $user->email");
        $this->info("As: $role");

        return 0;
    }

    private function askEmail()
    {
        $email = $this->ask('Set email');

        if (User::where('email', $email)->first()) {
            $this->warn("The email $email in the system is already taken");
            return $this->askEmail();
        }

        if (empty($email)) {
            $this->warn("Email cannot be empty!");
            return $this->askEmail();
        }

        return $email;
    }

    private function askPassword(): string
    {
        $password = $this->secret('Set password. Remember your password! (minimum 8 characters)');
        $length = Str::length($password);

        if ($length < 8) {
            $this->warn('Password must not be less than 8 characters');
            return $this->askPassword();
        }

        return Hash::make($password);
    }

    private function askIsAdmin(): bool
    {
        $is_admin = $this->ask('Administrator user? [Yes/no]', 'no');

        if ($is_admin === 'Yes') {
            return true;
        } elseif ($is_admin === 'no') {
            return false;
        }

        $this->warn('The answer should only be `Yes` or `no`');

        return $this->askIsAdmin();
    }
}
