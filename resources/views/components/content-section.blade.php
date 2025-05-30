<section>
    <h{{ $level }} class="my-2 section-title" id="{{ $anchor ?? Str::slug($title) }}">
        @if($hideAnchor)
            {{ Str::title($title) }}
        @else
            <a
                class="text-black before:text-uc-dkbrown before:content-['#'] before:mr-1"
                href='#{{ $anchor ?? Str::slug($title) }}'>{{ Str::title($title) }}</a>
        @endif
    </h{{ $level }}>
    <div class='ml-5 mr-2'>
        {{ $slot }}
    </div>
</section>
