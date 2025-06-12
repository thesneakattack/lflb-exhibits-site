@php($story = \App\Models\Tag::randomHeroStory())
@if ($story)
    <section class="relative w-full h-[25vh] bg-cover bg-center text-white flex items-center"
             style="background-image: url('{{ $story->main_image_url() }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="relative z-10 container mx-auto px-6 max-w-3xl">
            <h2 class="text-4xl font-extrabold mb-4">Featured Article</h2>

            <h3 class="text-2xl font-semibold mb-2">{{ $story->title }}</h3>

            <p class="text-base leading-relaxed mb-4">
                {{ Str::limit($story->description ?? 'Short Description of the article goes here.', 160) }}
            </p>

            <a href="/archive/{{ $story->lflb_category_id }}/{{ $story->lflb_sub_category_id }}/{{ $story->id }}"
               class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
                Read More
            </a>
        </div>
    </section>
@endif