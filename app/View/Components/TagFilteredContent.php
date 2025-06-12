<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagFilteredContent extends Component
{
    public string $modelClass;
    public array $tagFilters;
    public int $limit;
    public string $view;
    public string $mode;
    public $items;

    public function __construct(
        string $modelClass,
        string $tagFilters = '{}',
        int $limit = 5,
        string $view = 'default',
        string $mode = 'all' // ✅ default is "all"
    ) {
        $this->modelClass = $modelClass;
        $this->tagFilters = json_decode($tagFilters, true);
        $this->limit = $limit;
        $this->view = $view;
        $this->mode = $mode;

        $this->items = $this->fetchItems();
    }

    protected function fetchItems()
    {
        if (!class_exists($this->modelClass)) {
            return collect();
        }

        $query = $this->modelClass::query();

        foreach ($this->tagFilters as $type => $slug) {
            $query->whereHas('tags', fn($q) =>
                $q->where('type', $type)->where('slug', $slug)
            );
        }

        return match ($this->mode) {
            'first'  => $query->latest()->limit(1)->get(),
            'random' => $query->inRandomOrder()->limit($this->limit)->get(),
            'all'    => $query->latest()->get(),
            default  => $query->latest()->get(), // ✅ fallback to "all"
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view()->exists("components.tag-filtered-content.{$this->view}")
            ? view("components.tag-filtered-content.{$this->view}")
            : view("components.tag-filtered-content.default");
    }
}
// Example usage:
// {{-- Defaults to 'all' mode --}}
// <x-tag-filtered-content
//     model-class="\App\Models\LflbStory"
//     tag-filters='{"Primary":"biography","Section":"hero"}'
//     view="hero"
// />

// {{-- Limit to 1 random --}}
// <x-tag-filtered-content
//     model-class="\App\Models\LflbStory"
//     tag-filters='{"Section":"hero"}'
//     mode="random"
//     limit="1"
//     view="hero"
// />

// {{-- Return only the most recent item --}}
// <x-tag-filtered-content
//     model-class="\App\Models\LflbStory"
//     tag-filters='{"Section":"featured"}'
//     mode="first"
//     view="hero"
// />