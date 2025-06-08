<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    <ul class="space-y-2">
      @foreach ($components as $componentCategory => $componentList)
        <li>
          <x-content-section :title="$componentCategory">
            <ol class="grid grid-cols-[repeat(auto-fill,minmax(6rem,1fr))] gap-5">
              @foreach ($componentList as $component)
                <li class="flex flex-col items-center gap-3 text-center font-semibold">
                  <a
                    class="flex flex-1 flex-col items-center gap-1"
                    href="{{ $component->direct_link }}"
                  >
                    <span class="flex flex-1 items-center justify-center">
                      <img
                        src="{{ $component->image_link }}"
                        alt=""
                      />
                    </span>
                    {{ $component->name }}
                  </a>
                </li>
              @endforeach
            </ol>
          </x-content-section>
        </li>
      @endforeach
    </ul>
  </section>
</x-page>
