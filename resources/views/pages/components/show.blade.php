<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    <img
      src="{{ $consumable->image_link }}"
      alt="{{ $consumable->name }}"
    />
    <p class="my-2">Category: {{ $consumable->type }}</p>
  </section>
  <x-content-section title="Ingredient for">
    @if ($consumable->shopTransactionRequirements?->isEmpty())
      <p>Not required for any shop transaction.</p>
    @else
      <ol class="list-inside list-disc">
        @foreach ($consumable->shopTransactionRequirements as $requirement)
          <li>
            <a href="{{ route('shop.category.show', $requirement->shopTransaction->shopCategory) }}">
              {{ $requirement->shopTransaction->title }}
            </a>
          </li>
        @endforeach
      </ol>
    @endif
  </x-content-section>
  <x-content-section title="Reward of">
    @if ($consumable->shopTransactions?->isEmpty())
      <p>Could not be transmuted in the shop.</p>
    @else
      <ol class="list-inside list-disc">
        @foreach ($consumable->shopTransactions as $shopTransaction)
          <li>
            <a href="{{ route('shop.category.show', $shopTransaction->shopCategory) }}">
              {{ $shopTransaction->title }}
            </a>
          </li>
        @endforeach
      </ol>
    @endif
  </x-content-section>
  <x-content-section title="Dropped in exploration areas">
    @if ($consumable->explorationAreas?->isEmpty())
      <p>Did not drop from any exploration areas.</p>
    @else
      <ol class="list-inside list-disc">
        @foreach ($consumable->explorationAreas as $explorationArea)
          <li>
            <a href="{{ route('exploration.area.show', $explorationArea) }}">
              {{ $explorationArea->name }}
            </a>
          </li>
        @endforeach
      </ol>
    @endif
  </x-content-section>
  <x-content-section title="Dropped by creatures">
    @if ($consumable->creatures?->isEmpty())
      <p>Did not drop from any creatures.</p>
    @else
      <ol class="list-inside list-disc">
        @foreach ($consumable->creatures as $creature)
          <li>
            <a href="{{ $creature->direct_link }}">
              {{ $creature->name }}
            </a>
          </li>
        @endforeach
      </ol>
    @endif
  </x-content-section>
</x-page>
