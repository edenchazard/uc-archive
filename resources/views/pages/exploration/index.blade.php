<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    <ul class="grid grid-cols-[repeat(auto-fill,minmax(10rem,1fr))] gap-5">
      @foreach ($explorationAreas as $explorationArea)
        <li>
          <a
            class="flex flex-col items-center gap-3 text-center font-semibold"
            href="{{ route('exploration.area.show', $explorationArea) }}"
          >
            <div class="flex-1 content-center">
              <img
                src="{{ $explorationArea->image_link }}"
                alt=""
              />
            </div>
            {{ $explorationArea->name }}
          </a>
        </li>
      @endforeach
    </ul>
  </section>
</x-page>
