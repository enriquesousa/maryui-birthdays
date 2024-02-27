<div>

    <!-- HEADER -->
    <x-header title="Cumpleaños" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-warning" />
            <x-button label="Agregar" @click="$wire.addModal = true" responsive icon="o-plus" class="btn-success" />
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$users" :sort-by="$sortBy">

            @scope('cell_age', $user)
                {{ $user->dob->age }}
            @endscope

            @scope('actions', $user)
                <div class="flex space-x-1">
                    <x-button icon="o-pencil-square" wire:click="edit({{ $user['id'] }})" class="btn-ghost btn-sm text-blue-500"/>
                    <x-button icon="o-trash" wire:click="delete({{ $user['id'] }})" wire:confirm="Estas seguro?" spinner class="btn-ghost btn-sm text-red-500"/>
                </div>
            @endscope
        </x-table>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass"
            @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>

    {{-- Ventana Modal para Agregar, Notice `wire:model`, no `id="xxx"` --}}
    <x-modal wire:model="addModal" title="Agregar Cumpleaños" subtitle="Agregar la fecha de cumpleaños" separator>

        <x-form wire:submit="save">

            <x-input label="Nombre" wire:model="form.name" />
            <x-input label="Correo Electrónico" wire:model="form.email" />
            <x-datetime label="Fecha de Nacimiento" wire:model="form.dob" icon="o-calendar" />
         
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.addModal = false" />
                <x-button label="Guardar!" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>

        </x-form>

    </x-modal>

    {{-- Ventana Modal para Editar  --}}
    <x-modal wire:model="editModal" title="Editar Cumpleaños" subtitle="Editar la fecha de cumpleaños" separator>

        <x-form wire:submit="update">

            <x-input label="Nombre" wire:model="form.name" />
            <x-input label="Correo Electrónico" wire:model="form.email" />
            <x-datetime label="Fecha de Nacimiento" wire:model="form.dob" icon="o-calendar" />
         
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.editModal = false" />
                <x-button label="Update" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>

        </x-form>

    </x-modal>

</div>
