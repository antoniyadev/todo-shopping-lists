<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\ShoppingList;
new #[Layout('layouts.app')] class extends Component {
    public ShoppingList $list;
    public $title;
    public $items;
    public $recipient;
    public $sendDate;
    public $isPublished;

    public function mount(ShoppingList $list) {

        $this->authorize('update', $list);
        $this->fill($list);
        $this->title = $list->title;
        $this->recipient = $list->recipient;
        $this->sendDate = $list->send_date;
        $this->isPublished = $list->is_published;
        $this->items = $list->items->toArray();
    }
    public function update()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:3'],
            'recipient' => ['required', 'email'],
            'sendDate' => ['required', 'date'],
            'items.*.title' => 'required',
        ]);
        $this->list->update([
            'title' => $this->title,
            'recipient' => $this->recipient, 
            'send_date' => $this->sendDate,
            'is_published' => $this->isPublished
        ]);
        $this->list->items()->delete();
        if(isset($this->items)){
            $this->list->items()->createMany($this->items);
        }

        $this->dispatch('list-updated');
    }

    public function addItem()
    {
        $this->items[] = ['id' => '', 'title' => '', 'quantity' => ''];
    }

    public function removeItem($index)
    {
        $this->list->items()->delete($this->items[$index]['id']);
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }
}; ?>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Shopping List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto space-y-2 sm:px-6 lg:px-8">
            <form wire:submit='update' class="space-y-4">
                <x-input wire:model="title" label="Title" placeholder="Lidl"/>
                <x-button secondary wire:click.prevent="addItem">Add Item</x-button>
                
                @foreach ($items as $index => $item)
                <div class="flex gap-2">
                    <x-input wire:model="items.{{$index}}.title" label="Item #{{$index + 1}}"/>
                    <x-input wire:model="items.{{$index}}.quantity" label="quantity"/>
                    <x-button wire:click.prevent="removeItem({{$index}})" class="" negative flat>Remove</x-button>
                </div>
               
                @endforeach
                <x-input icon="user" wire:model="recipient" label="Recipient" placeholder="yourfriend@email.com" type="email"/>
                <x-input icon="calendar" wire:model="sendDate" type="date" label="Send Date"/> 
                <x-checkbox label="List Published" wire:model="isPublished">Published</x-checkbox>
                <div class="flex justify-between pt-4">
                    <x-button secondary type="submit" spinner="update">Update</x-button> 
                    <x-button href="{{route('shopping-lists.index')}}" flat negative>Back to Lists</x-button>
                </div>
                <x-action-message on="list-updated">Updated</x-action-message>
                <x-errors/>
            </form>
        </div>
    </div>
