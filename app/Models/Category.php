<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getStateAttribute()
    {
        return $this->is_active ? 'نشط' : 'غير نشط';
    }

    public function last_posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id')
            ->select(
                'id',
                'slug',
                'category_id',
                'user_id',
                'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
                'description_' . LaravelLocalization::getCurrentLocale() . ' as description',
                'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords',
                'content_' . LaravelLocalization::getCurrentLocale() . ' as content',
                'photo',
                'is_active',
                'created_at'
            )->whereIs_active('1')->orderByDesc('id');
    }
}
