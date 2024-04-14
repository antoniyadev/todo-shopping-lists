<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShoppingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {
            ShoppingList::factory()->count(10)->create([
                'user_id' => $user->id
            ])
                ->each(function ($list) {
                    $list->items()->saveMany(Item::factory()->count(5)->create([
                        'shopping_list_id' => $list->id
                    ]));
                });
        });
    }
}
