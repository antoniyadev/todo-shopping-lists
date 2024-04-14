<?php

use Livewire\Volt\Component;
use App\Models\ShoppingList;

new class extends Component
{
    public function delete($id)
    {
        $list = ShoppingList::where('id', $id)->first();
        $this->authorize('delete', $list);
        $list->delete();
    }
    public function with(): array
    {
        return [
            'shoppingLists' => Auth::user()
                ->shoppingLists()
                ->orderBy('send_date', 'asc')
                ->get(),
        ];
    }
}; ?>
<div>
    <div class="space-y-2">
        @if($shoppingLists->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">No shopping lists yet</p>
            <p class="text-sm">Let's create your first shopping list to send</p>
            <x-button primary icon-right="plus" class="mt-2" href="{{route('shopping-lists.create')}}" wire:navigate>Create List</x-button>
        </div>
        @else
        <x-button primary icon-right="plus" class="mb-12" href="{{route('shopping-lists.create')}}" wire:navigate>Create List</x-button>
        <div class="grid grid-cols-3 gap-4">
            @foreach ($shoppingLists as $shoppingList )
            <x-card wire:key='{{$shoppingList->id}}'>
                <div class="flex justify-between">
                    <div>
                        @can('update', $shoppingList)
                        <a href="{{route('shopping-lists.edit', $shoppingList)}}" wire:navigate class="text-xl font-bold hover:underline hover:text-blue-500">{{$shoppingList->title}}</a>
                        @else
                        <p class="text-xl font-bold hover:underline hover:text-gray-500">{{$shoppingList->title}}</p>
                        @endcan
                    </div>
                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($shoppingList->send_date)->format('d-M-Y')}}</div>
                </div>
                <div class="flex items-end justify-between mt-4 space-x-1">
                    <p class="text-xs">Recipient: <span class="font-semibold">{{$shoppingList->recipient}}</span></p>
                    <div>
                        <x-button.circle icon="eye" href="{{route('shopping-lists.view', $shoppingList)}}"></x-button.circle>
                        <x-button.circle wire:click="delete('{{$shoppingList->id}}')" icon="trash"></x-button.circle>
                    </div>
                </div>
            </x-card>
            @endforeach
        </div>
        @endif
    </div>
</div>