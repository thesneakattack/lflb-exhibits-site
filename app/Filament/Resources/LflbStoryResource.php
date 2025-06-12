<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LflbStoryResource\Pages;
use App\Filament\Resources\LflbStoryResource\RelationManagers;
use App\Models\LflbStory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LflbStoryResource\RelationManagers\TagsRelationManager;

class LflbStoryResource extends Resource
{
    protected static ?string $model = LflbStory::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Stories';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form->schema([]); // No editable fields, tag management only
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TagsColumn::make('tags.name')->separator(','),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLflbStories::route('/'),
            'edit' => Pages\EditLflbStory::route('/{record}/edit'),
        ];
    }
}

