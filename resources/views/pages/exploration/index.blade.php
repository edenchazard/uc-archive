<x-page :page='$page'>
    <section>
        <h1>Exploration Areas</h1>
        <ul class="grid grid-cols-[repeat(auto-fill,minmax(10rem,1fr))] gap-5">
            @foreach ($explorationAreas as $explorationArea)
                <li>
                    <a href="{{ route('exploration.area.show', $explorationArea) }}" class="text-center flex flex-col items-center font-semibold gap-3">
                        <div class="flex-1 content-center">
                            <img src="{{ $explorationArea->image_link }}" alt="" />
                        </div>
                        {{ $explorationArea->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </section>
</x-page>
