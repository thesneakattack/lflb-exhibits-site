<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Relations\Relation;


class SubcategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'subcategories';

    // public function form(Forms\Form $form): Forms\Form
    // {
    //     return $form->schema([
    //         Forms\Components\Select::make('id')
    //             ->label('Subcategory')
    //             ->relationship('subcategories', 'title')
    //             ->searchable()
    //             ->preload()
    //             ->required(),
    //     ]);
    // }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('id')->label('Subcategory ID'),
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