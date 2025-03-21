<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public function articleshow()
    {
        return $this->hasMany(ArticleShow::class);
    }
    public function articletag()
    {
        return $this->hasMany(ArticleTag::class);
    }
}
