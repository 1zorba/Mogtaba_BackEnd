<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class poems extends Model
// {

//     protected $fillable = [
//         'user_id',
//         'poem_title',
//         'poem_content',
//         'image',
//         'poem_link'
//     ];

//     public function User()
//     {
//         return $this->belongsTo(User::class);
//     }
// } 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poem extends Model // تصحيح الاسم ليبدأ بحرف كبير ومفرد
{
    use HasFactory;

    // تحديد اسم الجدول لأن اسم الكلاس تغير من poems إلى Poem
    protected $table = 'poems'; 

    protected $fillable = [
        'user_id',
        'poem_title',
        'poem_content',
        'image',
        'poem_link'
    ];

    // تصحيح اسم العلاقة ليبدأ بحرف صغير (Standard Convention)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}