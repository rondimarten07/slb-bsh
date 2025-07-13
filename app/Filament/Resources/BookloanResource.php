<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookloanResource\Pages;
use App\Filament\Resources\BookloanResource\RelationManagers;
use App\Filament\Resources\BookloanResource\Widgets\BookloanOverview;
use App\Models\Book;
use App\Models\Bookloan;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookloanResource extends Resource
{
    protected static ?string $model = Bookloan::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static ?string $modelLabel = 'Peminjaman Buku';

    protected static ?string $pluralModelLabel = 'Peminjaman Buku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('book_id')
                        ->relationship(name: 'book', titleAttribute: 'title')
                        ->searchable()
                        ->preload()
                        ->label('Judul Buku')
                        ->required(),
                    Select::make('user')
                        ->relationship(name: 'user', titleAttribute: 'name')
                        ->searchable()
                        ->preload()
                        ->label('Peminjam')
                        ->required(),
                    DateTimePicker::make('start_date')->label('Tanggal Pinjam')->required(),
                    DateTimePicker::make('end_date')->label('Tanggal Pengembalian')->required(),
                    Select::make('returned')->options([
                        0 => 'Belum Dikembalikan',
                        1 => 'Sudah Dikembalikan',
                    ])->default(0)->label('Status Pengembalian')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->rowIndex(),
                TextColumn::make('user.name')->label('Nama Peminjam'),
                TextColumn::make('book.title')->label('Judul Buku'),
                TextColumn::make('start_date')->label('Tanggal Pinjam'),
                TextColumn::make('end_date')->label('Tanggal Pengembalian'),
                IconColumn::make('returned')
                    ->boolean()
                    ->label('Status Pengembalian'),
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
            'index' => Pages\ListBookloans::route('/'),
            'create' => Pages\CreateBookloan::route('/create'),
            'view' => Pages\ViewBookloan::route('/{record}'),
            'edit' => Pages\EditBookloan::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'superadmin']);
    }
}
