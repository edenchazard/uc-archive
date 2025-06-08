<x-page>
  <div class="space-y-2">
    <section>
      <h1 class="mb-2">{{ Breadcrumbs::pageTitle() }}</h1>
      <x-formatted-block :text="$explorationArea->description" />
    </section>

    <x-content-section title="Materials">
      <ol class="grid grid-cols-[repeat(auto-fill,minmax(6rem,1fr))] gap-5">
        @foreach ($explorationArea->consumables as $component)
          <li class="flex flex-col items-center gap-3 text-center font-semibold">
            <a
              class="flex flex-col items-center gap-2"
              href="{{ $component->direct_link }}"
            >
              <div class="flex flex-1 items-center justify-center">
                <img
                  src="{{ $component->image_link }}"
                  alt=""
                />
              </div>
              {{ $component->name }}
            </a>
          </li>
        @endforeach
      </ol>
    </x-content-section>

    <x-content-section title="Stories">
      <ol>
        @foreach ($explorationArea->explorationStories as $story)
          <li class="grid grid-cols-[auto_auto_1fr] items-center gap-x-4">
            <h3 class="text-nowrap text-base font-semibold">{{ $story->title }}</h3>
            <x-article-link :url="route('exploration.area.story.show', [$explorationArea, $story])" />
            <div class="col-span-full line-clamp-1">
              {{ $story->story }}
            </div>
          </li>
        @endforeach
      </ol>
    </x-content-section>
  </div>
</x-page>
