<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);  // 'id_order' adalah foreign key di OrderItem
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);  // 'id_menu' adalah foreign key di OrderItem
    }
    public function table()
    {
        return $this->belongsTo(Table::class);  // 'id_order' adalah foreign key di OrderItem
    }
}
