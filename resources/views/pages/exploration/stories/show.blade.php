<x-page>
  <section>
      <h1>{{ Breadcrumbs::pageTitle() }}</h1>
      <x-formatted-block :text="$explorationStory->formatted_story" />
  </section>
  <section>
      <ol class="flex justify-between text-center">
          @foreach ($creatures as $creature)
              <li class="flex-1 flex flex-col items-center gap-4">
                <div class="flex-1 flex items-center justify-center">
                    <img src="{{ $creature->image_link }}" alt="" />
                </div>
                <span>{{ $creature->creature->name }}</span>
              </li>
          @endforeach
      </ol>
  </section>
</x-page>
