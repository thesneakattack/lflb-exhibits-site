<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagFilteredContent extends Component
{
    public $modelClass;
    public $tagFilters;
    public $limit;
    public $view;
    public $items;

    public function __construct(string $modelClass, string $tagFilters = '{}', int $limit = 5, string $view = 'default')
    {
        $this->modelClass = $modelClass;
        $this->tagFilters = json_decode($tagFilters, true);
        $this->limit = $limit;
        $this->view = $view;

        $this->items = $this->fetchItems();
    }

    protected function fetchItems()
    {
        if (!class_exists($this->modelClass)) return collect();

        $query = $this->modelClass::query();

        foreach ($this->tagFilters as $type => $slug) {
            $query->whereHas('tags', fn($q) => $q->where('type', $type)->where('slug', $slug));
        }

        return $query->latest()->limit($this->limit)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag-filtered-content.{$this->view}');
    }
}
