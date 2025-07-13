<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Auth;
use DB;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Notification;
use Spatie\Permission\Models\Role;
use Storage;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Staff & Guru';

    protected static ?string $modelLabel = 'Anggota';

    protected static ?string $pluralModelLabel = 'Anggota';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('email')->email(),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->hidden(Auth::user()->hasRole('teacher')),
                DatePicker::make('dob')->label('Tanggal Lahir'),
                FileUpload::make('avatar')
                        ->directory('uploads')
                        ->image()
                        ->label('Foto'),
                TextInput::make('address')->label('Alamat'),
                TextInput::make('disability_type')->label('Kebutuhan Khusus')
                    ->hidden(Auth::user()->hasRole('staff')),
                    
                Select::make('roles')
                    ->relationship('roles', 'name', fn (Builder $query) => $query->whereIn('name', ['staff', 'teacher']))
                    ->default(Role::where('name', 'student')->first()->id)
                    ->hidden(Auth::user()->hasRole('teacher'))
                    ->preload()
                    ->live(),
                
                TextInput::make('classroom')->label(Auth::user()->hasRole('teacher') ? 'Kelas' : 'Kelas yang Diajar')
                    ->visible(fn (Get $get): bool => $get('roles') == Role::where('name', 'teacher')->first()->id || Auth::user()->hasRole('teacher')),
            ]);
    }

    public static function table(Table $table): Table
    {
        $actions = [
            Tables\Actions\ViewAction::make(),
        ];

        if (Auth::user()->hasAnyRole(['superadmin', 'admin', 'staff'])) {
            array_push($actions, Tables\Actions\EditAction::make());
        }

        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();
                
                if ($user->hasRole('teacher')) { 
                    $studentRole = Role::where('name', 'student')->first();
                    if ($studentRole) {
                        $query->whereHas('roles', function ($q) use ($studentRole) {
                            $q->where('role_id', $studentRole->id);
                        });
                    }

                    $query->where('classroom', $user->classroom);
                }

                if ($user->hasRole('staff')) {
                    $roles = Role::whereIn('name', ['staff', 'teacher'])->pluck('id');

                    $query->whereHas('roles', function ($q) use ($roles) {
                        $q->whereIn('role_id', $roles);
                    });
                }

                if ($user->hasRole('admin')) {
                    // Get the role IDs for 'student' and 'staff'
                    $roles = Role::whereIn('name', ['student', 'staff'])->pluck('id');

                    // Filter users with either 'student' or 'staff' roles
                    $query->whereHas('roles', function ($q) use ($roles) {
                        $q->whereIn('role_id', $roles);
                    });
                }

                return $query;

            })
            ->columns([
                TextColumn::make('no')->rowIndex(),
                TextColumn::make('name')->sortable(),
                TextColumn::make('email')->sortable()->copyable()
                    ->hidden(Auth::user()->hasRole('teacer')),
                TextColumn::make('dob')->sortable()->date()->label('Tanggal Lahir'),
                ImageColumn::make('avatar')->label('Foto')->circular()
                    ->defaultImageUrl(Storage::url('uploads/no-image.jpg')),
                TextColumn::make('address')->sortable()->label('Alamat'),
                TextColumn::make('disability_type')->sortable()->label('Disabilitas')
                    ->hidden(Auth::user()->hasRole('staff')),
                TextColumn::make('classroom')->sortable()->label('Kelas')
                    ->hidden(Auth::user()->hasRole('staff')),
                TextColumn::make('roles.name')
                    ->hidden(Auth::user()->hasRole('teacher')),
            ])
            ->filters([
                //
            ])
            ->actions($actions)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['teacher', 'staff', 'admin', 'superadmin']);
    }

    public static function getNavigationLabel(): string
    {  
        if(Auth::user()->hasAnyRole(['teacher'])) {
            return 'Data Siswa';
        }
        if(Auth::user()->hasAnyRole(['staff'])) {
            return 'Staff & Guru';
        }

        return 'Staff, Guru, dan Siswa';
    }

    public static function getModelLabel(): string
    {
        if(Auth::user()->hasAnyRole(['teacher'])) {
            return 'Guru dan Siswa';
        }

        return 'Anggota';
    }

    public static function getPluralModelLabel(): string
    {
        if(Auth::user()->hasAnyRole(['teacher'])) {
            return 'Guru dan Siswa';
        }

        return 'Anggota';
    }

}
