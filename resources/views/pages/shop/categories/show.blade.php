<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    {{ $shopCategory->description }}
    <ul class="space-y-2">
      @foreach ($shopCategory->transactions as $transaction)
        <li>
          <h2>{{ $transaction->title }}</h2>
          <div>
            {{ $transaction->short_description }}
          </div>
          <div class="my-2 text-sm italic">
            {{ $transaction->description }}
          </div>
          <div class="flex flex-col items-center md:flex-row">
            <div class="flex w-32 flex-col items-center pb-4 text-center font-semibold md:pb-0 md:pr-8">
              @if ($transaction->rewardable)
                <a
                  class="flex flex-col items-center justify-center gap-1"
                  href="{{ $transaction->rewardable->direct_link }}"
                >
                  <img
                    src="{{ $transaction->rewardable->image_link }}"
                    alt="{{ $transaction->rewardable->name }}"
                  />
                  {{ $transaction->rewardable?->family?->name }}
                  {{ $transaction->rewardable->name }}
                  <span class="text-sm">(&times; {{ $transaction->amount }})</span>
                </a>
              @else
                <i>Unknown</i>
              @endif
            </div>
            <div
              class="border-uc-grad-begin grid w-full flex-1 grid-cols-[repeat(auto-fit,9rem)] gap-4 border-t-4 pt-4 md:border-l-4 md:border-t-0 md:pl-8 md:pt-0"
            >
              @foreach ($transaction->requirements as $requirement)
                <div class="flex flex-col items-center text-center">
                  <a
                    class="flex flex-1 flex-col gap-1"
                    href="{{ $requirement->requireable->direct_link }}"
                  >
                    <span class="flex flex-1 flex-col items-center justify-center">
                      <img
                        src="{{ $requirement->requireable->image_link }}"
                        alt="{{ $requirement->requireable->name }}"
                      />
                    </span>
                    <span class="font-semibold">{{ $requirement->requireable->name }}</span>
                    <span class="text-sm">(&times; {{ $requirement->amount }})</span>
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </section>
</x-page>
