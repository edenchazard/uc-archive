<x-page>
  <section>
      <h1>{{ Breadcrumbs::pageTitle() }}</h1>
      <x-formatted-block :text="$explorationStory->formatted_story" />
  </section>
  <section>
      <ol class="flex justify-between text-center">
          @foreach ($creatures as $creature)
              <li class="flex-1 flex flex-col items-center gap-4">
                  <a class="flex-1 flex items-center justify-center" href="{{ route('creatures.family.creature.show', [$creature->creature->family, $creature->creature]) }}">
                      <img src="{{ $creature->image_link }}" alt="" />
                  </a>
                  <span>{{ $creature->creature->name }}</span>
                  {{ $explorationStory->{"creature_{$loop->iteration}_option"} }}
              </li>
          @endforeach
      </ol>
  </section>
</x-page>
