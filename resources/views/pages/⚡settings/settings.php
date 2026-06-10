<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Validate;
use Livewire\Form;


class UserForm extends Form
{
    #[Validate(['required', 'min:3'])]
    public string $name;

    #[Validate(['required', 'min:5', 'email'])]
    public string $email;

    public bool $isAdmin = false;

    public function create()
    {
        User::create([
            "name" => $this->name,
            "email" => $this->email,
            "is_admin" => $this->isAdmin,
        ]);
    }
}

new class extends Component {
    public UserForm $newUser;

    public ?string $lastGeneratedLink = null;

    #[Computed]
    public function allUsers()
    {
        return User::with('passwordReset')->get();
    }

    public function generateUpdatePasswordLink(string $userId)
    {
        $user = User::with('passwordReset')->find($userId);

        $this->lastGeneratedLink = URL::to(
            route(
                'reset-password',
                [
                    'token' => app('auth.password.broker')->createToken($user),
                    'email' => $user->email,
                ],
                false,
            ),
        );
    }

    public function removeUser(string $userId)
    {
        User::find($userId)->delete();
    }

    public function createUser()
    {
        $this->newUser->create();
    }

    public function closeLinkWindow()
    {
        $this->lastGeneratedLink = null;
    }
};
