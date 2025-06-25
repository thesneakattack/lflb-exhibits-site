<?php

namespace App\ViewModels\Timeline;

use App\Models\LflbStory;
use App\Helpers\Breadcrumbs;

class StoryViewModel
{
    public function __invoke(LflbStory $story): array
    {
        return [
            'story' => $story,
            'breadcrumbs' => Breadcrumbs::forTimeline(),
        ];
    }
}