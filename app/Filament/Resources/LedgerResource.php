<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LedgerResource\Pages;
use App\Filament\Resources\LedgerResource\RelationManagers;
use App\Models\Ledger;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Number;
use Str;

class LedgerResource extends Resource
{
    protected static ?string $model = Ledger::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $modelLabel = 'Kas Sekolah';

    protected static ?string $pluralModelLabel = 'Kas Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name'),                  
                    TextInput::make('amount')->numeric(),
                    Select::make('direction')
                        ->options([
                            'IN' => 'Kas Masuk',
                            'OUT' => 'Kas Keluar'
                        ]),
                    DatePicker::make('date')->maxDate(now()),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->rowIndex(),
                TextColumn::make('name')->label('Nama'),
                TextColumn::make('amount')
                    ->formatStateUsing(fn ($state) => Str::of(Number::currency($state, 'IDR', 'id'))->replace(',00', ''))
                    ->label('Nominal'),
                TextColumn::make('direction')
                    ->badge()
                    ->label('Arus Kas'),
                TextColumn::make('date')
                    ->date()
                    ->label('Tanggal')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLedgers::route('/'),
            'create' => Pages\CreateLedger::route('/create'),
            'view' => Pages\ViewLedger::route('/{record}'),
            'edit' => Pages\EditLedger::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['treasurer', 'admin', 'superadmin', 'staff']);
    }
}
