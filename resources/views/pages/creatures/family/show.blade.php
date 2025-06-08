<x-page>
  <div class="space-y-2">
    <section id="family-introduction">
      <h1>{{ Breadcrumbs::pageTitle() }}</h1>
      <section id="evolutionary-line">
        <x-evolutionary-line
          class="justify-center"
          :stages="$stages"
        />
      </section>
      <div class="flex justify-center">
        <div class="mt-2 flex max-w-prose flex-col gap-2">
          <p>The <span class="font-bold">{{ $family->name }}</span> family was released on
            @if ($family->released)
              <time>{{ $family->released->format('jS F o') }}</time>
            @else
              an unrecorded date
            @endif with {{ count($stages) }} evolutions.
            @if ($family->gender <= 1)
              It was {{ GenderEnum::from($family->gender)->friendlyName() }}-only.
            @elseif ($family->gender === 3)
              It was available in both genders.
            @else
              It had a unique gender, {{ GenderEnum::from($family->gender)->friendlyName() }}.
            @endif
          </p>
          <p>All members within this family are of the {{ $family->element->value }} element with a rarity rating
            of {{ $family->rarity->friendlyName() }}{!! $family->unique_rating ? " <span class=\"font-bold\">({$family->unique_rating->value})</span>" : '' !!}.
            @if (!$family->deny_exalt)
              Noble versions would be
              {{ RarityCategoryEnum::from($family->rarity->value + 1)->friendlyName() }} and exalteds would be
              {{ RarityCategoryEnum::from($family->rarity->value + 2)->friendlyName() }}.
            @endif
          </p>
          <p>It could
            @if ($family->rarity->value <= 7)
              only be found through exploration{{ $family->in_basket ? ' or in the basket' : '' }}.
            @elseif ($family->rarity->value === 8)
              only be obtained via limited means, such as from events, the shop or transmutation.
            @elseif ($family->rarity->value === 10)
              only be bought from the exotic shop with an exotic credit
              @if ($family->unique_rating === UniqueRatingEnum::Exotic)
                at certain times of the year.
              @elseif ($family->unique_rating === UniqueRatingEnum::Legendary)
                during its period of availability. After leaving the shop, it was retired permanently.
              @endif
            @elseif ($family->rarity === 11)
              only be obtained by transmuting it from the shop
            @endif
          </p>
        </div>
      </div>
    </section>
    <x-content-section title="base stats">
      <table>
        <thead>
          <tr>
            @foreach ($family->base_stats->keys() as $stat)
              <th>{{ ucfirst($stat) }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($family->base_stats as $stat)
              <td class="even:bg-uc-blue text-center odd:bg-[#add0eb]">{{ $stat }}</td>
            @endforeach
          </tr>
        </tbody>
      </table>
    </x-content-section>

    <x-content-section title="evolutions">
      @foreach ($stages as $stage)
        <article
          class="not-first:mt-4 flex flex-col items-start justify-center gap-y-2"
          id="{{ Str::slug($stage->creature->name) }}"
        >
          <div class="flex flex-wrap items-end gap-3">
            @foreach (['normal' => $stage, ...$alts] as $altName => $alt)
              <div class="flex flex-col items-center justify-between">
                <img
                  src="{{ ($alt[$loop->parent->index] ?? $stage)->image_link }}"
                  alt="{{ ucfirst($altName) }}"
                />
                <span>{{ ucfirst($altName) }}</span>
              </div>
            @endforeach
          </div>
          <p class="text-sm italic">
            ({{ $stage->creature->artist ? "Art by {$stage->creature->artist}" : 'Artist unknown' }})</p>
          <div>
            <h3 class="inline font-medium">{{ $stage->creature->name }}</h3>
            <x-article-link :url="$stage->creature->direct_link" />
          </div>
          <section>
            <h4 class="font-medium">Visual Description</h4>
            <x-formatted-block :text="$stage->creature->short_description" />
          </section>
          <section>
            <h4 class="font-medium">Lifestyle</h4>
            <x-formatted-block :text="$stage->long_description" />
          </section>
        </article>
      @endforeach
    </x-content-section>
  </div>
</x-page>
