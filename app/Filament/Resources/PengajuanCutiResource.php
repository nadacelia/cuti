<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PengajuanCuti;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengajuanCutiResource\Pages;
use App\Filament\Resources\PengajuanCutiResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class PengajuanCutiResource extends Resource
{
    protected static ?string $model = PengajuanCuti::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('Nama')->required(),
                        TextInput::make('Keterangan')->required(),
                        DatePicker::make('Mulai Tanggal'),
                        DatePicker::make('Hingga Tanggal'),
                        Select::make('Jenis Cuti')->options([
                            'Cuti Tahunan'=>'Cuti Tahunan', 
                            'Cuti Bulanan'=>'Cuti Bulanan'
                        ])
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Nama')->searchable(),
                TextColumn::make('Keterangan')->searchable(),
                TextColumn::make('Mulai Tanggal')->searchable(),
                TextColumn::make('Hingga Tanggal')->searchable(),
                TextColumn::make('Jenis Cuti')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPengajuanCutis::route('/'),
            'create' => Pages\CreatePengajuanCuti::route('/create'),
            'edit' => Pages\EditPengajuanCuti::route('/{record}/edit'),
        ];
    }    
}
