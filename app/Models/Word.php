<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Word model
 */
class Word extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dictionary_id'];

    /*
    * Get the dictionary that owns the word.
    */
    public function dictionary()
    {
        return $this->belongsTo(Dictionary::class);
    }
}
