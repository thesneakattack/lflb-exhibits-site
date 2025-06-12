<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Relations\Relation;
// use Illuminate\Support\Facades\Log;

class StoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'stories';

    // public function form(Forms\Form $form): Forms\Form
    // {
    //     return $form->schema([
    //         Forms\Components\Select::make('id')
    //             ->label('Story')
    //             ->relationship('stories', 'title')
    //             ->searchable()
    //             ->preload()
    //             ->required(),
    //     ]);
    // }

    public function table(Tables\Table $table): Tables\Table
    {
        // Log::info('Tag → stories query:', [
        //     'sql' => $this->ownerRecord->stories()->toSql(),
        //     'bindings' => $this->ownerRecord->stories()->getBindings(),
        // ]);
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('id')->label('Story ID'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->recordSelectSearchColumns(['title'])
                    ->recordTitleAttribute('title'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
