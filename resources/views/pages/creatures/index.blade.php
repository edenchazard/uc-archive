<x-page>
    <section>
        <h1>{{ Breadcrumbs::pageTitle() }}</h1>
    </section>
    <section id='list' class='flex gap-x-10 items-center'>
        Jump to section:
        <nav class="tracking-wider line text-xl leading-10">
            @foreach ($groups as $category => $families)
            <a href='#{{$category}}'>{{$category}}</a>
            @endforeach
        </nav>
    </section>
    <section class="mt-3">
        @foreach ($groups as $category => $families)
        <div class="relative">
            <div class='sticky top-0 bg-uc-blue p-1 flex flex-row justify-between'>
                <h2 id='{{$category}}'>
                    <a href='#{{$category}}' class='text-white'>{{$category}}</a>
                </h2>
                <a href="#list" aria-label="back to start of list" class='sticky p-1 bg-uc-mdbrown rounded-xs'>top</a>
            </div>
            <ol class="list-none">
                <li>
                    <ol>
                        @foreach ($families as $family)
                        <li class="my-10">
                            <div class="flex flex-row gap-2 items-center">
                                <h3 class="text-lg">{{$family['family']->name}}</h3>
                                <x-article-link :url='route("creatures.family.show", $family)' />
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
