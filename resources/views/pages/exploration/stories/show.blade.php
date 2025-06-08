<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    <x-formatted-block :text="$explorationStory->formatted_story" />
  </section>
  <nav>
    <ol class="flex justify-between text-center">
      @foreach ($creatures as $creature)
        <li class="flex flex-1 flex-col items-center gap-4">
          <a
            class="flex flex-1 flex-col"
            href="{{ $creature->creature->direct_link }}"
          >
            <span class="flex flex-1 items-center justify-center">
              <img
                src="{{ $creature->image_link }}"
                alt=""
              />
            </span>
            <span>{{ $creature->creature->name }}</span>
          </a>
          {{ $explorationStory->storyOptions[$loop->index]->formatted_description }}
        </li>
      @endforeach
    </ol>
  </nav>
</x-page>
