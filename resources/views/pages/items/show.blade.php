<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    <img
      src="{{ $item->image_link }}"
      alt="{{ $item->name }}"
    />
    @if ($item->description)
      <div class="my-2">
        {{ $item->description }}
      </div>
    @else
      <p>No description.</p>
    @endif
  </section>
  <x-content-section title="Ingredient for">
    @if ($item->shopTransactionRequirements?->isEmpty())
      <p>Not required for any shop transaction.</p>
    @else
      <ol class="list-inside list-disc">
        @foreach ($item->shopTransactionRequirements as $requirement)
          <li>
            <a href="{{ $requirement->shopTransaction->shopCategory->direct_link }}">
              {{ $requirement->shopTransaction->title }}
            </a>
          </li>
        @endforeach
      </ol>
    @endif
  </x-content-section>
  <x-content-section title="Reward of">
    @if ($item->shopTransactions?->isEmpty())
      <p>Could not be transmuted in the shop.</p>
    @else
      <ol class="list-inside list-disc">
        @foreach ($item->shopTransactions as $shopTransaction)
          <li>
            <a href="{{ $shopTransaction->shopCategory->direct_link }}">
              {{ $shopTransaction->title }}
            </a>
          </li>
        @endforeach
      </ol>
    @endif
  </x-content-section>
</x-page>
