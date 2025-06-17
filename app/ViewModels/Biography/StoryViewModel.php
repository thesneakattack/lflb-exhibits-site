<?php

namespace App\ViewModels\Biography;

use App\Models\LflbStory;
use App\Helpers\Breadcrumbs;

class StoryViewModel
{
    public function __invoke(LflbStory $story): array
    {
        return [
            'story' => $story,
            'breadcrumbs' => Breadcrumbs::forBiography(),
        ];
    }
}
