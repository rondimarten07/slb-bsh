<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PresenceResource\Pages;
use App\Filament\Resources\PresenceResource\RelationManagers;
use App\Models\Presence;
use App\Models\User;
use Auth;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class PresenceResource extends Resource
{
    protected static ?string $model = Presence::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $modelLabel = 'Kehadiran Siswa';

    protected static ?string $pluralModelLabel = 'Kehadiran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([ 
                    DatePicker::make('date')->label('Tanggal')->maxDate(now()),
                    Select::make('note')
                        ->helperText('Sakit, Izin, Alpa')
                        ->options([
                            'hadir' => 'Hadir',
                            'sakit' => 'Sakit',
                            'izih' => 'Izin',
                            'alpa' => 'Alpa',
                        ]),
                    Select::make('Nama Siswa')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();
                
                $members = User::all();
                if ($user->hasRole('teacher')) { 
                    $members = User::role(['student']);
                }

                if ($user->hasRole('staff')) {
                    $members = User::role(['student']);
                }

                if ($user->hasRole('admin')) {
                    $members = User::role(['student', 'staff']);
                }

                return Presence::query()->whereIn('user_id', $members->pluck('id'));  

            })
            ->columns([
                TextColumn::make('no')->rowIndex(),
                TextColumn::make('user.name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('date')->label('Tanggal')->date(),
                TextColumn::make('note')->limit(50)->label('Catatan'),
            ])
            ->defaultGroup('date')
            ->groups([
                Group::make('date')->date()->titlePrefixedWithLabel(false)
            ])
            ->filters([
                Filter::make('date')
                        ->form([
                            DatePicker::make('date_from'),
                            DatePicker::make('date_until'),
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['date_from'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                                )
                                ->when(
                                    $data['date_until'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                                );
                        })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Action::make('Laporan Kehadiran')
                    ->url(fn (): string => route('filament.admin.resources.presences.sheet'))
                    ->icon('heroicon-o-printer'),
            ])
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
            'index' => Pages\CardView::route('/'),
            'list' => Pages\ListPresences::route('/list'),
            'create' => Pages\CreatePresence::route('/create'),
            'edit' => Pages\EditPresence::route('/{record}/edit'),
            'sheet' => Pages\AttendanceSheet::route('/sheet'),
            'qr' => Pages\QrPresence::route('/qr'),
            'students-report' => Pages\StudentsReport::route('/students-report'),
            'attendance-input' => Pages\AttendanceInput::route('/attendance-input'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['teacher', 'admin', 'superadmin']);
    }

    public static function getNavigationLabel(): string
    {
        return 'Kehadiran Siswa';
    }
}
