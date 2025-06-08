<x-page>
  <section>
    <h1>{{ Breadcrumbs::pageTitle() }}</h1>
  </section>
  <section
    class="flex items-center gap-x-10"
    id="list"
  >
    Jump to section:
    <nav class="line text-xl leading-10 tracking-wider">
      @foreach ($groups as $category => $families)
        <a href="#{{ $category }}">{{ $category }}</a>
      @endforeach
    </nav>
  </section>
  <section class="mt-3">
    @foreach ($groups as $category => $families)
      <div class="relative">
        <div class="bg-uc-blue sticky top-0 flex flex-row justify-between p-1">
          <h2 id="{{ $category }}">
            <a
              class="text-white"
              href="#{{ $category }}"
            >{{ $category }}</a>
          </h2>
          <a
            class="bg-uc-mdbrown rounded-xs sticky p-1"
            href="#list"
            aria-label="back to start of list"
          >top</a>
        </div>
        <ol class="list-none">
          <li>
            <ol>
              @foreach ($families as $family)
                <li class="my-10">
                  <div class="flex flex-row items-center gap-2">
                    <h3 class="text-lg">{{ $family['family']->name }}</h3>
                    <x-article-link :url="$family['family']->direct_link" />
                  </div>
                  <x-evolutionary-line :stages="$family['stages']" />
                </li>
              @endforeach
            </ol>
          </li>
        </ol>
      </div>
    @endforeach
  </section>
</x-page>

@push('scripts')
  <script type="module">
    document.querySelector('#show-images').addEventListener('change', function() {
      const action = this.checked ? 'add' : 'remove';
      document.querySelectorAll('.creature-image').forEach(img => {
        const action = this.classList[action]('display');
      });
    });
  </script>
@endpush
