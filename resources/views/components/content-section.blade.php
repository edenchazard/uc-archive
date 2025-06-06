<section {{ $attributes->class(['w-full overflow-hidden']) }}>
  <h{{ $level }} id="{{ $anchor ?? Str::slug($title) }}">
    @if ($hideAnchor)
      {{ Str::title($title) }}
    @else
      <a
        class="before:text-uc-dkbrown/50 text-black before:mr-1 before:content-['#']"
        href="#{{ $anchor ?? Str::slug($title) }}"
      >{{ Str::title($title) }}</a>
    @endif
    </h{{ $level }}>
    <div class="mr-2 w-full overflow-x-auto pl-5">
      {{ $slot }}
    </div>
</section>
