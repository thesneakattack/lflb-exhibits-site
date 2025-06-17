<?php

namespace App\ViewModels\Tagged;

use App\Models\Tag;
use App\Models\LflbStory;
use App\Helpers\Breadcrumbs;

class StoryViewModel
{
    public function __invoke(Tag $tag, LflbStory $story): array
    {
        return [
            'story' => $story,
            'tag' => $tag,
            'breadcrumbs' => Breadcrumbs::forStoryFromTag($tag, $story),
        ];
    }
}