<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;
    protected $fillable = ['phone_number_id', 'category', 'slug'];
    public function phoneNumber() {
        return $this->belongsTo(PhoneNumber::class);
    }
}
