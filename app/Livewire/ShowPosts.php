<?php

namespace App\Livewire;

use App\Livewire\Forms\PostForm;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Collection;
use Mary\Traits\Toast;

class ShowPosts extends Component
{
    use Toast;

    public string $search = '';

    public bool $drawer = false;

    public bool $addModal = false;

    public bool $editModal = false;

    // Reglas de validación
    public PostForm $form;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete(User $user): void
    {
        $id = $user->id;
        $user->delete();
        $this->success("Usuario con ID #$id", ' Eliminado con éxito.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    /**
     * Traer datos de la base de datos User
     */
    public function users(): Collection
    {
        return User::all()
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(User $item) => str($item['name'])->contains($this->search, true));
            });
    }

    
    public function save(): void
    {
        $this->form->store();

        $this->success('Usuario Creado con éxito.', position: 'toast-bottom');
        $this->addModal = false;
    }


    public function edit(User $record): void
    {
        $this->form->fillForm($record);
        $this->editModal = true;
    }


    public function update(): void
    {
        $this->form->update();
        $this->success('Registro actualizado con éxito.', position: 'toast-bottom');
        $this->editModal = false;
    }

    public function render()
    {
        $users = $this->users();
        $headers = $this->headers();
        return view('livewire.show-posts', compact('users', 'headers'));
    }
}
