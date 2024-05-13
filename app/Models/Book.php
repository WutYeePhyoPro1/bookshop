<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['book_uniq_id','bookname','co_id_link','publisher_id','cover_photo','created_timetick'];

    public function content_owner()
    {
        return $this->hasOne(ContentOwner::class,'id','co_id_link');
    }

    public function publisher()
    {
        return $this->hasOne(Publisher::class,'id','publisher_id');
    }
}
