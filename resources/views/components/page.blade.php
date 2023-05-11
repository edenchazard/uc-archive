<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $page['title'] ?? 'Unnamed Page' }}</title>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-uc-blue font-sans font-normal font-base">
        <div class='max-w-5xl m-auto drop-shadow-[0px_0px_8px_rgba(200,204,179,0.9)]'>
            <header>
                <div
                    id='banner'
                    role='presentation'
                    class="h-[232px] bg-[url('../../resources/css/images/bannerv2_clean.png')] bg-no-repeat bg-center">
                </div>
                <div class='drop-shadow-lg flex flex-row items-center justify-between bg-uc-mdbrown p-4'>
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
                </div>
            </header>
            {{-- 
            @if (isset($page['route']))
                <section id='breadcrumb' aria-label="Breadcrumb" class='bg-uc-ltbrown text-xs'>
                    {{ Breadcrumbs::render($page['route'], $page['name']) }}
                </section>
            @endif --}}
            <main class='bg-gradient-to-b from-uc-grad-begin to-uc-grad-end bg-uc-grad-end bg-[length:100%_526px] bg-no-repeat p-5'>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
