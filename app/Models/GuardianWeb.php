<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianWeb extends Model
{
    use HasFactory;
    public function articles(){
        return $this->belongsToMany(Article::class, 'pivot_guardian_webs_articles', 'guardian_web_id', 'article_id');
    }
}
