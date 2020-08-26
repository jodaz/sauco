<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NullFine extends Model
{
    protected $table = 'null_fines';

    protected $fillable = [
        'reason',
        'user_id',
        'fine_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }
}