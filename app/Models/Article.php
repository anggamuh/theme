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
    public function articlebanner()
    {
        return $this->hasMany(ArticleBanner::class);
    }
    public function articlegallery()
    {
        return $this->hasMany(articlegallery::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function articletag()
    {
        return $this->belongsToMany(ArticleTag::class, 'pivot_articles_tags', 'article_id', 'tag_id');
    } 
    public function template()
    {
        return $this->belongsToMany(Template::class, 'pivot_templates_articles', 'article_id', 'template_id');
    }
}
