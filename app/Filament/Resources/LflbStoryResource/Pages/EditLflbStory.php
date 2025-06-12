<?php

namespace App\Filament\Resources\LflbStoryResource\Pages;

use App\Filament\Resources\LflbStoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLflbStory extends EditRecord
{
    protected static string $resource = LflbStoryResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }
}
