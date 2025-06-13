<?php

namespace App\Filament\Resources\LflbStoryResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class TagsRelationManager extends RelationManager
{
    protected static string $relationship = 'tags';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->label('Type')->badge()->color(fn($state) => match ($state) {
                    'main' => 'success',
                    'category' => 'info',
                    'feature' => 'info',
                    'theme' => 'warning',
                    default => 'gray',
                }),                
                Tables\Columns\TextColumn::make('slug'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                ->preloadRecordSelect()
                ->recordTitleAttribute('name')
                ->multiple(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}