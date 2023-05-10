<x-page :data='$page'>
    <section id="family-introduction">
        <h1>Family: {{$familyData->name}}</h1>
        <section id='evolutionary-line'>
            <ol class='flex flex-row flex-wrap items-stretch list-none gap-2 justify-center'>
                @foreach ($stages as $creature)
                    <li class="flex flex-col justify-between items-center">
                        <span>{{ $creature->name }}</span>
                        <img src='{{ asset("images/creatures/" . $familyData->name . "/" . strtolower($familyData->name . "_" . $creature->name . ".png")) }}' alt="{{ $creature->name }}" />
                    </li>
                    <li aria-hidden="true" role="presentation" class="flex flex-col items-center justify-center">→</li>
                @endforeach
            </ol>
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
            <article class='flex flex-wrap justify-center items-start gap-10 p-5 md:flex-nowrap md:flex-row' id='{{ $creature->name }}'>
                <div class='flex flex-col items-center w-30'>
                    <img src='{{ asset("images/creatures/" . $familyData->name . "/" . strtolower($familyData->name . "_" . $creature->name . ".png")) }}' alt="{{ $creature->name }}" />
                    <h3>{{ $creature->name }}</h3>
                    <a class='main-article' href='{{ route("creature", [$familyData->name, $creature->name]) }}' aria-labelledby="{{ $creature->name }}">article</a>
                </div>
                <div class='shrink creature-descriptions'>
                    <section>
                        <h4 class='font-medium'>Visual Description</h4>
                        <x-creature-formatted-block :text="$creature->shortDescription" :creature="$creature" />
                    </section>
                    <section class="mt-4">
                        <h4 class='font-medium'>Lifestyle</h4>
                        <x-creature-formatted-block :text="$creature->longDescription" :creature="$creature" />
                    </section>
                </div>
            </article>
        @endforeach
    </section>
</x-page>
