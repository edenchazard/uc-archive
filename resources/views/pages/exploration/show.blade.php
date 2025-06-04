<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    <x-formatted-block :text="$explorationArea->description" />
  </section>

  <x-content-section title="Materials">
    <ol class="grid grid-cols-[repeat(auto-fill,minmax(6rem,1fr))] gap-5">
      @foreach ($explorationArea->consumables as $component)
        <li class="flex flex-col items-center gap-3 text-center font-semibold">
          <div class="flex-1 content-center">
            <img
              src="{{ $component->image_link }}"
              alt=""
            />
          </div>
          {{ $component->name }}
        </li>
      @endforeach
    </ol>
  </x-content-section>

  <x-content-section title="Stories">
    <ol class="space-y-2">
      @foreach ($explorationArea->explorationStories as $story)
        <li class="flex items-center gap-4">
          <h3 class="text-nowrap text-base font-semibold">{{ $story->title }}</h3>
          <x-article-link :url="route('exploration.area.story.show', [$explorationArea, $story])" />
          <div class="line-clamp-1">
            {{ $story->story }}
          </div>
        </li>
      @endforeach
    </ol>
  </x-content-section>
</x-page>
