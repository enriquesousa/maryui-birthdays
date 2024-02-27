<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    // ? es para indicar que puede ser null
    public ?User $record;

    #[validate('required')]
    public string $name = '';

    #[validate('required', 'email')]
    public string $email = '';

    #[validate('required', 'date')]
    public string $dob = '';

    public function fillForm(User $record): void
    {
        $this->record = $record;
        $this->name = $record->name;
        $this->email = $record->email;
        $this->dob = $record->dob->format('Y-m-d');
    }

    public function store(): void
    {
        $this->validate();

        User::create(
            $this->all()
        );

        $this->reset();
    }   

    public function update(): void
    {
        $this->validate();  

        $this->record->update(
            $this->all()
        );

        $this->reset(); 
    }

}
