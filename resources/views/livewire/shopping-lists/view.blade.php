<?php

use Livewire\Volt\Component;
use App\Models\ShoppingList;
use Livewire\Attributes\Layout;
use App\Models\Item;

new #[Layout('layouts.guest')] class extends Component {
    public ShoppingList $list;
    public $doneItemIds;

    public function mount() {
        $this->doneItemIds = $this->list->items->where('is_done', 1)->pluck('id')->toArray();
    }
    public function processItem($itemId) 
    {
        $item = Item::find($itemId);
        $item->update(['is_done' => !$item['is_done']]);
    }
}; ?>
<div>
    <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{$list->title}}
        </h2>
    </div>
    @foreach ($list->items as $item) 
    <div class="flex justify-startitems-right">
        <x-checkbox wire:model="doneItemIds" value="{{$item->id}}" wire:change="processItem({{$item->id}})"/> {{$item->title}} - {{$item->quantity}}
    </div>
    @endforeach
</div>