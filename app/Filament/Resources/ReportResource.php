<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use App\Models\User;
use Auth;
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
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $modelLabel = 'Laporan Siswa';

    protected static ?string $pluralModelLabel = 'Laporan Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([ 
                    DatePicker::make('date')->label('Tanggal')->maxDate(now()),
                    RichEditor::make('note')->label('Catatan'),
                    Select::make('user_id')->label('Siswa')->required()
                        ->options(function () {
                            $user = Auth::user();
                            
                            $members = User::all();
                            if ($user->hasRole('teacher')) { 
                                $members = User::role('student')->where('classroom', $user->classroom);
                            }
            
                            if ($user->hasRole('staff')) {
                                $members = User::role(['student', 'staff', 'teacher']);
                            }
            
                            if ($user->hasRole('admin')) {
                                $members = User::role(['student', 'staff']);
                            }

                            return $members->pluck('name', 'id');
                        })
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
                    $members = User::role('student')->where('classroom', $user->classroom);
                }

                if ($user->hasRole('staff')) {
                    $members = User::role(['student', 'staff', 'teacher']);
                }

                if ($user->hasRole('admin')) {
                    $members = User::role(['student', 'staff']);
                }

                return Report::query()->whereIn('user_id', $members->pluck('id'));
            })
            ->columns([
                // TextColumn::make('no')->rowIndex(),
                Split::make([
                    TextColumn::make('date')->label('Tanggal'),
                    TextColumn::make('note')->limit(50)->label('Catatan')->html(),
                ])
            ])
            ->defaultGroup('user.name')
            ->groups([
                Group::make('user.name')->titlePrefixedWithLabel(false)
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
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Action::make('Laporan')
                //     ->url(fn (Report $record): string => route('filament.admin.resources.reports.monthly-report', $record))
            ])
            ->headerActions([
                Action::make('Laporan')
                    ->url(fn (): string => route('filament.admin.resources.reports.monthly-report', Auth::user()->id))
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'view' => Pages\ViewReport::route('/{record}'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
            'summary' => Pages\SummaryReport::route('/{record}/summary'),
            'monthly-report' => Pages\MonthlyReport::route('/{record}/monthly-report'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'superadmin']);
    }
}
