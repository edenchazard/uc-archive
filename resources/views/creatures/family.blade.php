<x-page :data='$page'>
    <section id="family-introduction">
        <h1>Family: {{$familyData->name}}</h1>
        <section id='evolutionary-line'>
            <x-evolutionary-line :family='$familyData' class="justify-center" />
        </section>
    </section>
    <section id='general'>
        <h2 class="my-2 section-title">
            <a href='#general'>General</a>
        </h2>
        <div class='table'>
            <div class="table-header-group">
                @foreach ($generalAttributes as $name => $value)
                    <div class="table-row odd:bg-[#add0eb] even:bg-uc-blue">
                        <div class="table-cell text-left p-1 pl-4">{{ ucfirst($name) }}</div>
                        <div class="table-cell text-left p-1 pr-4">{{ ucfirst($value) }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id='evolutions' class="mt-4">
        <h2 class="my-2 section-title">
            <a href='#evolutions'>Evolutions</a>
        </h2>
        @foreach ($stages as $creature)
            <article class='flex flex-col justify-center items-start p-3 gap-2' id='{{ $creature->name }}'>
                    <img
                        src='{{ CreatureUtils::imageLink($creature) }}'
                        alt="{{ $creature->name }}"
                        class="self-start" />
                    <div>
                        <h3 class='inline font-medium'>{{ $creature->name }}</h3>
                        <x-article-link :url='route("creature", [$familyData->name, $creature->name])' />
                    </div>
                    <section>
                        <h4 class='font-medium'>Visual Description</h4>
                        <x-creature-formatted-block :text="$creature->shortDescription" :creature="$creature" />
                    </section>
                    <section>
                        <h4 class='font-medium'>Lifestyle</h4>
                        <x-creature-formatted-block :text="$creature->longDescription" :creature="$creature" />
                    </section>
            </article>
        @endforeach
    </section>
</x-page>
