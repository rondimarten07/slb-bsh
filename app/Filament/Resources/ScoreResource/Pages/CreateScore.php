<?php

namespace App\Filament\Resources\ScoreResource\Pages;

use App\Filament\Resources\ScoreResource;
use App\Models\Score;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateScore extends CreateRecord
{
    protected static string $resource = ScoreResource::class;
    protected static string $view = 'filament.resources.score-resource.pages.create';

    public $name;
    public $user_id;
    public $class;
    public $semester;
    public $year;
    public $nisn;

    public $spiritual_attitude;
    public $social_attitude;

    public $religion_knowledge;
    public $religion_skill;
    public $nation_knowledge;
    public $nation_skill;
    public $indonesia_knowledge;
    public $indonesia_skill;
    public $math_knowledge;
    public $math_skill;
    public $english_knowledge;
    public $english_skill;
    public $science_knowledge;
    public $science_skill;
    public $social_knowledge;
    public $social_skill;

    public $art_knowledge;
    public $art_skill;
    public $sport_knowledge;
    public $sport_skill;
    public $local_wisdom_knowledge;
    public $local_wisdom_skill;

    public $interest_subject;
    public $interest_knowledge;
    public $interest_skill;

    public $independence_subject;
    public $independence_knowledge;
    public $independence_skill;

    public $extraordinary_knowledge;
    public $extraordinary_skill;

    public $sick;
    public $permission;
    public $absent;


    
    protected function getViewData(): array
    {
        return [
            'students' => User::role('student')->get(),
        ];
    }

    public function submit()
    {
        $this->name = User::where('id', $this->user_id)->first()->name;
        // Save logic
        Score::create([
            'name' => $this->name,
            'user_id' => $this->user_id,
            'class' => $this->class,
            'semester' => $this->semester,
            'year' => $this->year,
            'nisn' => $this->nisn,
            
            'spiritual_attitude' => $this->spiritual_attitude,
            'social_attitude' => $this->social_attitude,

            'religion_knowledge' => $this->religion_knowledge,
            'religion_skill' => $this->religion_skill,
            'nation_knowledge' => $this->nation_knowledge,
            'nation_skill' => $this->nation_skill,
            'indonesia_knowledge' => $this->indonesia_knowledge,
            'indonesia_skill' => $this->indonesia_skill,
            'math_knowledge' => $this->math_knowledge,
            'math_skill' => $this->math_skill,
            'english_knowledge' => $this->english_knowledge,
            'english_skill' => $this->english_skill,
            'science_knowledge' => $this->science_knowledge,
            'science_skill' => $this->science_skill,
            'social_knowledge' => $this->social_knowledge,
            'social_skill' => $this->social_skill,

            'art_knowledge' => $this->art_knowledge,
            'art_skill' => $this->art_skill,
            'sport_knowledge' => $this->sport_knowledge,
            'sport_skill' => $this->sport_skill,
            'local_wisdom_knowledge' => $this->local_wisdom_knowledge,
            'local_wisdom_skill' => $this->local_wisdom_skill,

            'interest_subject' => $this->interest_subject,
            'interest_knowledge' => $this->interest_knowledge,
            'interest_skill' => $this->interest_skill,

            'independence_subject' => $this->independence_subject,
            'independence_knowledge' => $this->independence_knowledge,
            'independence_skill' => $this->independence_skill,
            
            'extraordinary_knowledge' => $this->extraordinary_knowledge,
            'extraordinary_skill' => $this->extraordinary_skill,
            
            'sick' => $this->sick,
            'permission' => $this->permission,
            'absent' => $this->absent,
        ]);

        Notification::make()->success()->title('Score saved')->send();
        $this->redirect(ScoreResource::getUrl('index'));
    }
}
