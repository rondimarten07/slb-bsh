<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\Widgets;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Keuangan Donasi';

    protected static ?string $modelLabel = 'Donasi';

    protected static ?string $pluralModelLabel = 'Donasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Donatur/Keterangan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('amount')
                    ->label('Nominal')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Select::make('direction')
                    ->label('Jenis Transaksi')
                    ->options([
                        'IN' => 'Donasi Masuk',
                        'OUT' => 'Donasi Keluar'
                    ])
                    ->required(),
                DatePicker::make('date')
                    ->label('Tanggal')
                    ->required()
                    ->default(now()),
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
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'IN' => 'Masuk',
                        'OUT' => 'Keluar',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'IN' => 'success',
                        'OUT' => 'danger',
                        default => 'gray',
                    })
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'view' => Pages\ViewDonation::route('/{record}'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            Widgets\DonationOverview::class,
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['treasurer', 'admin', 'superadmin']);
    }
} 