<x-page :page='$page'>
    <section>
        <h1>{{ $explorationArea->name }}</h1>
        <p>{{ $explorationArea->description }}</p>
    </section>

    <x-content-section :title='"Materials"'>
        <ol class="grid grid-cols-[repeat(auto-fill,minmax(6rem,1fr))] gap-5">
            @foreach ($explorationArea->consumables as $component)
                <li class="text-center flex flex-col items-center font-semibold gap-3">
                  <div class="flex-1 content-center">
                      <img src="{{ $component->image_link }}" alt="" />
                  </div>
                  {{ $component->name }}
                </li>
            @endforeach
        </ol>
    </x-content-section>

    <x-content-section :title='"Stories"'>
        <ol>
            @foreach ($explorationArea->explorationStories as $story)
                <li class="">
                    <span class="font-semibold">{{ $story->title }}</span>
                    <p>{{ $story->story }}</p>
                </li>
            @endforeach
        </ol>
    </x-content-section>
</x-page>
