<div>
    <h1>{{ $count }}</h1>
 
    {{-- <button wire:click="increment">+</button>
 
    <button wire:click="decrement">-</button> --}}


    <x-button label="+" class="btn-success" wire:click="increment"/>

    <x-button label="-" class="btn-error" wire:click="decrement"/>

</div>