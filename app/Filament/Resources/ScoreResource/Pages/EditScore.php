<?php

namespace App\Filament\Resources\ScoreResource\Pages;

use App\Filament\Resources\ScoreResource;
use App\Models\Score;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditScore extends EditRecord
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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'students' => User::role('student')->get(),
        ];
    }

    public function mount($record): void
    {
        parent::mount($record);
        
        $record = Score::find($record);

        // load student list
        $this->students = User::role('student')->get();

        // fill form props from the database record
        $this->name     = $record->name;
        $this->user_id  = $record->user_id;
        $this->class    = $record->class;
        $this->semester = $record->semester;
        $this->year     = $record->year;
        $this->nisn     = $record->nisn;

        $this->spiritual_attitude = $record->spiritual_attitude;
        $this->social_attitude    = $record->social_attitude;

        $this->religion_knowledge = $record->religion_knowledge;
        $this->religion_skill     = $record->religion_skill;
        $this->nation_knowledge   = $record->nation_knowledge;
        $this->nation_skill       = $record->nation_skill;
        $this->indonesia_knowledge = $record->indonesia_knowledge;
        $this->indonesia_skill     = $record->indonesia_skill;
        $this->math_knowledge     = $record->math_knowledge;
        $this->math_skill         = $record->math_skill;
        $this->english_knowledge  = $record->english_knowledge;
        $this->english_skill      = $record->english_skill;
        $this->science_knowledge  = $record->science_knowledge;
        $this->science_skill      = $record->science_skill;
        $this->social_knowledge   = $record->social_knowledge;
        $this->social_skill       = $record->social_skill;

        $this->art_knowledge      = $record->art_knowledge;
        $this->art_skill          = $record->art_skill;
        $this->sport_knowledge    = $record->sport_knowledge;
        $this->sport_skill        = $record->sport_skill;
        $this->local_wisdom_knowledge = $record->local_wisdom_knowledge;
        $this->local_wisdom_skill = $record->local_wisdom_skill;

        $this->interest_subject   = $record->interest_subject;
        $this->interest_knowledge = $record->interest_knowledge;
        $this->interest_skill     = $record->interest_skill;

        $this->independence_subject = $record->independence_subject;
        $this->independence_knowledge = $record->independence_knowledge;
        $this->independence_skill   = $record->independence_skill;

        $this->extraordinary_knowledge = $record->extraordinary_knowledge;
        $this->extraordinary_skill     = $record->extraordinary_skill;

        $this->sick     = $record->sick;
        $this->permission = $record->permission;
        $this->absent   = $record->absent;
    }

    public function submit()
    {
        $this->name = User::where('id', $this->user_id)->first()->name;
        // Save logic
        $this->record->update([
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

        Notification::make()->success()->title('Score updated')->send();
        $this->redirect(ScoreResource::getUrl('index'));
    }
}
