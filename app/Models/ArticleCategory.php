<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;
    protected $fillable = ['phone_number_id', 'category', 'slug'];
    public function articles(){
        return $this->belongsToMany(Article::class, 'pivot_articles_categories', 'category_id', 'article_id');
    }
    public function phoneNumber() {
        return $this->belongsTo(PhoneNumber::class);
    }
}
