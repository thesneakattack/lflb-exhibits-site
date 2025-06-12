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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TagsColumn;

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
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('id')->label('Story ID'),
                TagsColumn::make('tags.name')->label('Tags')->separator(','),
                TextColumn::make('direct_url')
                    ->label('Direct URL')
                    ->getStateUsing(fn (LflbStory $record) => url('/story/' . $record->id))
                    ->url(fn (LflbStory $record) => url('/story/' . $record->id))
                    ->openUrlInNewTab()
                    // ->copyable(),
            ])
            ->defaultSort('title', 'desc');
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

