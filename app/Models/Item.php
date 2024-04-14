<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'quantity', 'is_done'];
    public function shoppingList()
    {
        return $this->belongsTo(ShoppingList::class);
    }
}
