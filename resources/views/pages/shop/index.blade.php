<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    <ul class="grid grid-cols-[repeat(auto-fill,minmax(10rem,1fr))] gap-5">
      @foreach ($categories as $category)
        <li>
          <a
            class="flex flex-col items-center gap-3 text-center font-semibold"
            href="{{ $category->direct_link }}"
          >
            <div class="flex-1 content-center">
              <img alt="" />
            </div>
            {{ $category->title }}
          </a>
        </li>
      @endforeach
    </ul>
  </section>
</x-page>
