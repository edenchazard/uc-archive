<x-page>
  <aside aria-label="creatures by id order">
    <ul class="flex flex-row flex-wrap items-end justify-between">
      <x-creature-nav
        direction="previous"
        :pet="$closestCreatures['previous']"
      ></x-creature-nav>
      <x-creature-nav
        direction="current"
        :pet="$pet"
      ></x-creature-nav>
      <x-creature-nav
        direction="next"
        :pet="$closestCreatures['next']"
      ></x-creature-nav>
    </ul>
  </aside>
  <div class="space-y-2">
    <section id="creature-introduction">
      <h1>{{ Breadcrumbs::pageTitle() }}</h1>
      <h2 class="text-sm italic">
        From the
        <a
          class="main-article"
          href="{{ $family->direct_link }}"
          aria-labelledby="{{ $pet->creature->name }}"
        >{{ $family->name }}</a>
        family
      </h2>
      <div class="flex flex-row flex-wrap justify-center gap-3">
        <img
          class="self-center"
          src="{{ $pet->image_link }}"
          alt="{{ $pet->creature->name }}"
        />
        <div class="max-w-sm">
          <div class="flex flex-col gap-2">
            <p><span class="font-bold">{{ $pet->creature->name }}</span> was drawn
              {{ $pet->creature->artist ? "by  {$pet->creature->artist}" : 'by an unknown artist' }} and is
              the
              {{ Number::ordinal($pet->creature->stage) }}{{ $pet->creature->required_clicks === 0 ? ' and final' : '' }}
              evolution of the {{ $family->name }} family, and {{ Number::ordinal($pet->creature->id) }}
              creature overall.</p>
            <p>Being a member of the {{ $family->name }} family, its elemental type is
              {{ $family->element->value }} with a rarity rating of
              {{ $family->rarity->friendlyName() }}{!! $family->unique_rating ? " <span class=\"font-bold\">({$family->unique_rating->value})</span>" : '' !!}.</p>
            @if ($family->released)
              <p>It was released on <time>{{ $family->released->format('jS F o') }}</time>.</p>
            @else
              <p>Its release date is unknown.</p>
            @endif
            <p class="flex flex-col flex-wrap gap-3 py-3 sm:flex-nowrap sm:px-5 md:flex-row">
              <a
                class="shrink-0 self-center"
                href="{{ $pet->creature->consumable->direct_link }}"
              >
                <img
                  src="{{ $pet->creature->consumable->image_link }}"
                  alt="{{ $pet->creature->consumable->name }}"
                />
              </a>
              Interacting with {{ $pet->creature->name }} while exploring would earn you the
              {{ $pet->creature->consumable->name }} component.
              @if ($pet->creature->required_clicks > 0)
                It requires {{ $pet->creature->required_clicks }} clicks to evolve.
              @endif
            </p>
          </div>
        </div>
      </div>
    </section>
    <x-content-section title="visual description">
      <x-formatted-block :text="$pet->short_description" />
    </x-content-section>
    <x-content-section title="lifestyle">
      <x-formatted-block :text="$pet->long_description" />
    </x-content-section>
    <x-content-section title="variations">
      @if ($alts->isNotEmpty())
        <div class="flex flex-wrap items-end gap-3">
          @foreach (['normal' => $pet, ...$alts] as $altName => $alt)
            @if (!$alt->image_link)
              @continue
            @endif
            <div class="flex flex-col items-center justify-between">
              <img
                src="{{ $alt->image_link }}"
                alt="{{ ucfirst($altName) }}"
              />
              <span>{{ ucfirst($altName) }}</span>
            </div>
          @endforeach
        </div>
      @else
        N/A
      @endif
    </x-content-section>
    <x-content-section title="Max Stats">
      @if ($pet->creature->max_stat_points > 0)
        <table>
          <thead>
            <tr>
              @foreach ([...$pet->creature->max_stats->keys(), 'Total'] as $stat)
                <th class="px-2">{{ ucfirst($stat) }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr>
              @foreach ([...$pet->creature->max_stats, $pet->creature->max_stat_points] as $stat)
                <td class="even:bg-uc-blue text-center odd:bg-[#add0eb]">{{ $stat }}</td>
              @endforeach
            </tr>
          </tbody>
        </table>
      @else
        N/A
      @endif
    </x-content-section>
    <x-content-section title="training options">
      @if ($pet->creature->trainingOptions->count() > 0)
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Energy Cost</th>
              <th>Reward</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pet->creature->trainingOptions as $option)
              <tr>
                <td>{{ $option->title }}</td>
                <td class="text-center">{{ $option->energy_cost }}</td>
                <td><x-formatted-block :text="$option->formatted_reward" /></td>
                <td>
                  <x-formatted-block :text="$option->format($pet)" />
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        N/A
      @endif
    </x-content-section>

    <x-content-section title="exploration stories">
      @if ($explorationStories->isNotEmpty())
        <p>This creature featured in the following exploration stories:</p>
        <ol class="flex list-inside list-disc flex-col gap-3">
          @foreach ($explorationStories as $story)
            <li>
              <a
                class="main-article"
                href="{{ $story->direct_link }}"
              >
                {{ $story->title }}
              </a>
            </li>
          @endforeach
        </ol>
      @else
        <p>This creature didn't feature in any exploration stories.</p>
      @endif
    </x-content-section>
  </div>
</x-page>
