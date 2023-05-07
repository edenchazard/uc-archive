<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-uc-blue font-sans font-normal font-base">
        <div class='max-w-5xl m-auto drop-shadow-[0px_0px_8px_rgba(200,204,179,0.9)]'>
            <header class='drop-shadow-lg flex flex-row items-center justify-between bg-uc-mdbrown p-4'>
                <div>
                    UC Archive
                </div>
                <nav id='menu' class='grow'>
                    <ul class='flex flex-row flex-wrap justify-end text-uc-dkbrown uppercase text-sm font-medium'>
                        <li class='p-2'>Home</li>
                        <li class='p-2'>Creatures</li>
                        <li class='p-2'>Items</li>
                    </ul>
                </nav>
            </header>
            <section id='breadcrumb' aria-label="Breadcrumb" class='bg-uc-ltbrown text-xs'>
                {{ Breadcrumbs::render('family', $familyData->name) }}
            </section>
            <main class='bg-gradient-to-b from-uc-grad-begin to-uc-grad-end bg-uc-grad-end bg-[length:100%_526px] bg-no-repeat p-5'>
                <section id="family-introduction">
                    <h1>Family: {{$familyData->name}}</h1>
                    <section id='evolutionary-line'>
                        <ol class='flex flex-row flex-wrap items-stretch list-none gap-2 justify-center'>
                            @foreach ($stages as $creature)
                                <li class="flex flex-row items-center">
                                    <span>{{ $creature->name }}</span>
                                    <img src='{{ asset("images/creatures/" . $familyData->name . "/" . strtolower($familyData->name . "_" . $creature->name . ".png")) }}' alt="{{ $creature->name }}" />
                                </li>
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
                                    {!! $creature->shortDescription !!}
                                </section>
                                <section class="mt-4">
                                    <h4 class='font-medium'>Lifestyle</h4>
                                    {!! $creature->longDescription !!}
                                </section>
                            </div>
                        </article>
                    @endforeach
                </section>
            </main>
        </div>
    </body>
</html>
