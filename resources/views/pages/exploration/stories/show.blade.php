<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    <x-formatted-block :text="$explorationStory->formatted_story" />
  </section>
  <section>
    <ol class="flex justify-between text-center">
      @foreach ($creatures as $creature)
        <li class="flex flex-1 flex-col items-center gap-4">
          <a
            class="flex flex-1 items-center justify-center"
            href="{{ route('creatures.family.creature.show', [$creature->creature->family, $creature->creature]) }}"
          >
            <img
              src="{{ $creature->image_link }}"
              alt=""
            />
          </a>
          <span>{{ $creature->creature->name }}</span>
          {{ $explorationStory->storyOptions[$loop->index]->formatted_description }}
        </li>
      @endforeach
    </ol>
  </section>
</x-page>
