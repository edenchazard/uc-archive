<section>
    <h{{ $level }} class="my-2 section-title" id="{{ $anchor ?? str_replace([' '], '-', strtolower($title)) }}">
        @if($hideAnchor)
            {{ implode(array_map('ucfirst', explode(' ', $title))) }}
        @else
            <a 
                class="text-black before:text-uc-dkbrown before:content-['#'] before:mr-1"
                href='#{{ $anchor ?? str_replace([' '], '-', strtolower($title)) }}'>{{ implode(' ', array_map('ucfirst', explode(' ', $title))) }}</a>
        @endif
    </h{{ $level }}>
    <div class='ml-5 mr-2'>
        {{ $slot }}
    </div>
</section>