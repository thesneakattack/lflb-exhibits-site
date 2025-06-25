<?php

namespace App\ViewModels\Archive;

use App\Models\LflbCategory;

class IndexViewModel
{
    public function __invoke(): array
    {
        $topics = LflbCategory::where('featured', 'TRUE')
            ->whereHas('lflbSubCategories')
            ->with('lflbSubCategories')
            ->orderBy('title', 'ASC')
            ->paginate(6);

        return [
            'topics' => $topics,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => url('/')],
                ['label' => 'Topics', 'url' => null],
            ],
        ];
    }
}
