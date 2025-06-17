<?php

namespace App\ViewModels\Archive;

use App\Models\LflbCategory;
use App\Helpers\Breadcrumbs;

class CategoryViewModel
{
    public function __invoke(LflbCategory $topic): array
    {
        return [
            'topic' => $topic,
            'breadcrumbs' => Breadcrumbs::forCategory($topic),
        ];
    }
}
