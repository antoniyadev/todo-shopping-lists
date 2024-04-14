<x-guest-layout>
    <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{$list->title}}
        </h2>
    </div>
    @foreach ($list->items as $item) 
    <div class="flex justify-startitems-right">
        Status: {{var_export($item->status)}}
        <x-checkbox wire:model="{{$item->status}}"/> {{$item->title}} - {{$item->quantity}}
    </div>
    @endforeach
</x-guest-layout>