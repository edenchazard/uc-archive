<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    {{ $shopCategory->description }}
    <ul class="space-y-2">
      @foreach ($shopCategory->transactions as $transaction)
        <li>
          <h2>{{ $transaction->title }}</h2>
          <div>
            {{ $transaction->description }}
          </div>
          <div class="mt-2 flex items-center">
            <div class="flex flex-col items-center text-center font-semibold w-32">
              @if ($transaction->rewardable)
                <img
                  src="{{ $transaction->rewardable->image_link }}"
                  alt="{{ $transaction->rewardable->name }}"
                />
                @if ($transaction->rewardable::class === \App\Models\Creature::class)
                  {{ $transaction->rewardable->family->name }}
                @endif
                {{ $transaction->rewardable->name }}
              @else
                <i>Unknown</i>
              @endif
            </div>
            <div class="ml-8 border-l-4 border-uc-grad-begin grid flex-1 grid-cols-[repeat(auto-fit,9rem)] gap-4">
              @foreach ($transaction->requirements as $requirement)
                <div class="flex flex-col items-center text-center">
                  <div class="flex flex-1 items-center">
                    <img
                      src="{{ $requirement->requireable->image_link }}"
                      alt="{{ $requirement->requireable->name }}"
                    />
                  </div>
                  <span class="text-sm">(&times; {{ $requirement->amount }})</span>
                  <span class="font-semibold">{{ $requirement->requireable->name }}</span>
                </div>
              @endforeach
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </section>
</x-page>
