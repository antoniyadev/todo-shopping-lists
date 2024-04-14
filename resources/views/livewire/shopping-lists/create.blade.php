<?php

use Livewire\Volt\Component;

new class extends Component {
    public $title;
    public $items = [];
    public $recipient;
    public $sendDate;

    public function submit() 
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:3'],
            'recipient' => ['required', 'email'],
            'sendDate' => ['required', 'date'],
            'items.*.title' => 'required',
        ]);

        auth()->user()->shoppingLists()->create([
            'title' => $this->title,
            'recipient' => $this->recipient, 
            'send_date' => $this->sendDate,
            'is_published' => true
        ])->items()->createMany(
            collect($this->items)
                ->map(fn ($item) => [
                    'title' => $item['title'], 'quantity' => $item['quantity']])
                ->all()
        );
        redirect(route('shopping-lists.index'));
    }

    public function addItem()
    {
        $this->items[] = [
            'title' => '',
            'quantity' => ''
        ];
    }
    
    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }
}; ?>

<div>
    <form wire:submit='submit' class="space-y-4">
        <x-input wire:model="title" label="Title" placeholder="Lidl"/>
        @foreach ($items as $index => $item)
        <div class="flex gap-2">
            <x-input wire:model="items.{{$index}}.title" label="Item #{{$index + 1}}"/>
            <x-input wire:model="items.{{$index}}.quantity" label="quantity"/>
            <x-button wire:click.prevent="removeItem({{$index}})" class="" negative flat>Remove</x-button>
        </div>
        @endforeach
        <x-button secondary wire:click.prevent="addItem">Add Item</x-button>
        <x-input icon="user" wire:model="recipient" label="Recipient" placeholder="yourfriend@email.com" type="email"/>
        <x-input icon="calendar" wire:model="sendDate" type="date" label="Send Date"/> 
        <div class="pt-4">
            <x-button primary type="submit" right-icon="calendar" spinner>Submit</x-button> 
        </div>
        <x-errors/>
    </form>
</div>
