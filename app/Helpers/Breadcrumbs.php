<?php

namespace App\Helpers;

use App\Models\LflbCategory;
use App\Models\LflbSubCategory;
use App\Models\LflbStory;
use App\Models\Tag;

class Breadcrumbs
{
    public static function home(): array
    {
        return [
            ['label' => 'Home', 'url' => null],
        ];
    }

    public static function forCategory(LflbCategory $category): array
    {
        return [
            ['label' => 'Topics', 'url' => route('archive')],
            ['label' => $category->title, 'url' => null],
        ];
    }

    public static function forSubCategory(LflbCategory $category, LflbSubCategory $subCategory): array
    {
        return [
            ['label' => 'Topics', 'url' => route('archive')],
            ['label' => $category->title, 'url' => route('archive.topic', ['topic' => $category->id])],
            ['label' => $subCategory->title, 'url' => null],
        ];
    }

    public static function forStoryInArchive(LflbCategory $category, LflbSubCategory $subCategory, LflbStory $story): array
    {
        return [
            ['label' => 'Topics', 'url' => route('archive')],
            ['label' => $category->title, 'url' => route('archive.topic', ['topic' => $category->id])],
            ['label' => $subCategory->title, 'url' => route('archive.subtopic', ['topic' => $category->id, 'subtopic' => $subCategory->id])],
            ['label' => $story->title, 'url' => null],
        ];
    }

    public static function forTagged(Tag $tag): array
    {
        return [
            ['label' => 'Tagged', 'url' => route('tagged.index')],
            ['label' => $tag->name, 'url' => null],
        ];
    }

    public static function forStoryFromTag(Tag $tag, LflbStory $story): array
    {
        return [
            ['label' => 'Tagged', 'url' => route('tagged.index')],
            ['label' => $tag->name, 'url' => route('tagged.show', ['tag' => $tag->slug])],
            ['label' => $story->title, 'url' => null],
        ];
    }

    public static function forTimeline(): array
    {
        return [
            ['label' => 'Timeline', 'url' => null],
        ];
    }

    public static function forBiography(): array
    {
        return [
            ['label' => 'Biography', 'url' => null],
        ];
    }

    public static function forGenericStory(LflbStory $story): array
    {
        return [
            ['label' => 'Stories', 'url' => route('stories.index')],
            ['label' => $story->title, 'url' => null],
        ];
    }
}
