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

        foreach ($this->tagFilters as $type => $slugOrArray) {
            $query->whereHas('tags', function ($q) use ($type, $slugOrArray) {
                $q->where('type', $type);

                // ✅ allow single slug or array of slugs
                if (is_array($slugOrArray)) {
                    $q->whereIn('slug', $slugOrArray);
                } else {
                    $q->where('slug', $slugOrArray);
                }
            });
        }

        return match ($this->mode) {
            'first'  => $query->latest()->limit(1)->get(),
            'random' => $query->inRandomOrder()->limit($this->limit)->get(),
            'all'    => $query->latest()->limit($this->limit)->get(),
            default  => $query->latest()->limit($this->limit)->get() // fallback still respects limit
            
        };
    }

    public function render(): View|Closure|string
    {
        return view()->exists("components.tag-filtered-content.{$this->view}")
            ? view("components.tag-filtered-content.{$this->view}", ['items' => $this->items])
            : view("components.tag-filtered-content.default", ['items' => $this->items]);
    }
}
// Example usage:
// {{-- Defaults to 'all' mode --}}
// <x-tag-filtered-content
//     model-class="\App\Models\LflbStory"
//     tag-filters='{"primary":["biography","timeline"],"section":["hero","featured"]}'
//     mode="random"
//     limit="3"
//     view="grid"
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