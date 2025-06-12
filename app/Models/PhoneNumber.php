<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;
    protected $fillable = ['no_tlp'];
    public function article()
    {
        return $this->hasMany(ArticleShow::class);
    }
    public function articletag()
    {
        return $this->hasMany(ArticleTag::class);
    }
}
