<?php

namespace App\Filament\Resources\LflbStoryResource\Pages;

use App\Filament\Resources\LflbStoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLflbStories extends ListRecords
{
    protected static string $resource = LflbStoryResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
