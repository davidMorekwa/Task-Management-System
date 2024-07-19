<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function personAssigned()
    {
        return $this->belongsTo(User::class, 'person_assigned_id');
    }
}
