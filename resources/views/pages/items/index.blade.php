<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
  </section>
  <section class="mt-2">
    <ol class="grid grid-cols-[repeat(auto-fill,minmax(6rem,1fr))] gap-5">
      @foreach ($items as $item)
        <li class="flex flex-1 gap-3 text-center font-semibold">
          <a
            class="flex flex-col items-center gap-2"
            href="{{ $item->direct_link }}"
          >
            <div class="flex flex-1 items-center justify-center">
              <img
                src="{{ $item->image_link }}"
                alt=""
              />
            </div>
            <span>{{ $item->name }}</span>
          </a>
        </li>
      @endforeach
    </ol>
  </section>
</x-page>
