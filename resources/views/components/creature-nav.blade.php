<li aria-current="{{ $direction === 'current' }}">
  @if ($pet)
    <a
      class="flex flex-col items-center text-center"
      href="{{ $pet->creature->direct_link }}"
    >
      <img
        class="max-h-10 max-w-10 self-center"
        src="{{ $pet->image_link }}"
        alt=""
      />
      <span>#{{ $pet->creature->id }}</span>
      <span>{{ $pet->creature->name }}</span>
      @if ($direction === 'current')
        <span class="font-bold">This creature</span>
      @else
        {{ ucfirst($direction) }}
      @endif
    </a>
  @elseif ($direction === 'next')
    End
  @elseif ($direction === 'previous')
    Start
  @endif
</li>
