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
    // protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form->schema([]); // No editable fields, tag management only
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('id')->label('Story ID')->sortable(),
                TagsColumn::make('tags')->label('Tags')
                ->getStateUsing(fn($record) =>
                    $record->tags->map(fn($tag) => ucfirst($tag->type) . ': ' . $tag->name)->all()
                )
                ->color(fn ($state) => match (true) {
                    str_contains($state, 'Main:') => 'success',
                    str_contains($state, 'Category:') => 'info',
                    str_contains($state, 'Feature:') => 'info',
                    str_contains($state, 'Theme:')   => 'warning',
                    default                          => 'gray',
                }),          
                TextColumn::make('direct_url')
                    ->label('Direct URL')
                    ->getStateUsing(fn (LflbStory $record) => url('/story/' . $record->id))
                    ->url(fn (LflbStory $record) => url('/story/' . $record->id))
                    ->openUrlInNewTab()
                    // ->copyable(),
            ])
            ->defaultSort('tags_count', 'desc')
            ->modifyQueryUsing(function (Builder $query) {
                $query->withCount('tags');
            })
            ->filters([
                Tables\Filters\Filter::make('tags')
                ->label('Tags')
                ->form([
                    Forms\Components\Select::make('tag_ids')
                    ->label('Select Tags')
                    ->multiple()
                    ->options(\App\Models\Tag::pluck('name', 'id')->toArray()),
                ])
                ->indicateUsing(function (array $data): ?string {
                    if (empty($data['tag_ids'])) return null;
                    $count = count($data['tag_ids']);
                    return "Filtered by {$count} tag" . ($count > 1 ? 's' : '');
                })                
                ->query(function (Builder $query, array $data): Builder {
                    if (!empty($data['tag_ids'])) {
                        foreach ($data['tag_ids'] as $tagId) {
                            $query->whereHas('tags', fn($q) => $q->where('tags.id', $tagId));
                        }
                    }
                    return $query;
                }),
            ]);
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

