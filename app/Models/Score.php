<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class',
        'semester',
        'year',
        'nisn',

        'spiritual_attitude',
        'social_attitude',

        'religion_knowledge',
        'religion_skill',
        'nation_knowledge',
        'nation_skill',
        'indonesia_knowledge',
        'indonesia_skill',
        'math_knowledge',
        'math_skill',
        'english_knowledge',
        'english_skill',
        'science_knowledge',
        'science_skill',
        'social_knowledge',
        'social_skill',

        'art_knowledge',
        'art_skill',
        'sport_knowledge',
        'sport_skill',
        'local_wisdom_knowledge',
        'local_wisdom_skill',

        'interest_subject',
        'interest_knowledge',
        'interest_skill',

        'independence_subject',
        'independence_knowledge',
        'independence_skill',
        
        'extraordinary_knowledge',
        'extraordinary_skill',
        
        'sick',
        'permission',
        'absent',

        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
