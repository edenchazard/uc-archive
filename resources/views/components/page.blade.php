<!DOCTYPE html>
<html
  class="motion-safe:scroll-smooth motion-reduce:scroll-auto"
  lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
  <meta charset="utf-8">
  <title>{{ Breadcrumbs::headTitle() }}</title>
  <meta
    name="description"
    content="An unofficial archive of the content from the game Unicreatures."
  >
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1"
  >
  <meta
    name="theme-color"
    content="#7ae789"
  >
  <meta
    property="og:title"
    content="Unicreatures Archive"
  />
  <meta
    property="og:url"
    content="{{ URL::current() }}"
  />
  <meta
    property="og:type"
    content="website"
  />
  <meta
    property="og:image"
    content="{{ asset('images/og-image.png') }}"
  />
  <meta
    property="og:description"
    content="An unofficial archive of the content from the game Unicreatures."
  />
  <link
    type="image/x-icon"
    href="{{ asset('/images/favicon.ico') }}"
    rel="icon"
  >
  @vite('resources/css/app.css')
  @stack('css')
  @stack('scripts')
</head>

<body class="bg-uc-blue font-base font-sans font-normal antialiased">
  <div class="m-auto max-w-5xl drop-shadow-[0px_0px_8px_rgba(200,204,179,0.9)]">
    <header>
      <div
        class="h-[232px] bg-center bg-no-repeat"
        id="banner"
        role="presentation"
        style="background-image: url({{ asset('images/bannerv2_clean.webp') }})"
      >
      </div>
      <div class="bg-uc-mdbrown flex flex-row items-center justify-between p-4 drop-shadow-lg">
        <div>
          Unicreatures Archive
        </div>
        <nav
          class="grow"
          id="menu"
        >
          <ul class="text-uc-dkbrown flex flex-row flex-wrap justify-end text-sm font-medium uppercase">
            @foreach ([['home', route('home')], ['creatures', route('creatures.index')]] as $route)
              <li class="p-2"><a href="{{ $route[1] }}">{{ $route[0] }}</a></li>
            @endforeach
          </ul>
        </nav>
      </div>
    </header>
    <div
      class="bg-linear-to-b from-uc-grad-begin to-uc-grad-end bg-uc-grad-end bg-size-[100%_526px] bg-no-repeat sm:p-5"
    >
      <section
        id="breadcrumb"
        aria-label="Breadcrumb"
      >
        {{ Breadcrumbs::render() }}
      </section>
      <main>
        {{ $slot }}
      </main>
    </div>
  </div>
</body>

</html>
