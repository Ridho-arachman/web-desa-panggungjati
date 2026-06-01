<?php

namespace App\Filament\Resources\CitizenInputs;

use App\Filament\Resources\CitizenInputs\Pages\CreateCitizenInput;
use App\Filament\Resources\CitizenInputs\Pages\EditCitizenInput;
use App\Filament\Resources\CitizenInputs\Pages\ListCitizenInputs;
use App\Filament\Resources\CitizenInputs\Schemas\CitizenInputForm;
use App\Filament\Resources\CitizenInputs\Tables\CitizenInputsTable;
use App\Models\CitizenInput;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CitizenInputResource extends Resource
{
    protected static ?string $model = CitizenInput::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Masukan Warga';

    protected static ?string $modelLabel = 'Masukan';

    protected static ?string $pluralModelLabel = 'Masukan Warga';


    public static function form(Schema $schema): Schema
    {
        return CitizenInputForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CitizenInputsTable::configure($table);
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
            'index' => ListCitizenInputs::route('/'),
            'create' => CreateCitizenInput::route('/create'),
            'edit' => EditCitizenInput::route('/{record}/edit'),
        ];
    }
}
