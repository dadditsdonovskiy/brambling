<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Dictionary model
 */
class Dictionary extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'name',
    ];

    /**
     * Get the words for the dictionary.
     */
    public function words()
    {
        return $this->hasMany(Word::class);
    }
}
