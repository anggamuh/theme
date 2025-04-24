<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;
    protected $fillable = ['phone_number_id', 'tag', 'slug'];
    public function phoneNumber() {
        return $this->belongsTo(PhoneNumber::class);
    }
}
