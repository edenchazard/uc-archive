<section>
  <h{{ $level }}
    class="section-title my-2"
    id="{{ $anchor ?? Str::slug($title) }}"
  >
    @if ($hideAnchor)
      {{ Str::title($title) }}
    @else
      <a
        class="before:text-uc-dkbrown text-black before:mr-1 before:content-['#']"
        href="#{{ $anchor ?? Str::slug($title) }}"
      >{{ Str::title($title) }}</a>
    @endif
    </h{{ $level }}>
    <div class="ml-5 mr-2">
      {{ $slot }}
    </div>
</section>
