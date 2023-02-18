<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $table = 'polls';
    protected $fillable = [
        'poll_description',
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
