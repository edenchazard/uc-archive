<div>
  <div
    {{ $attributes->merge(['class' => 'grid flex-row items-stretch auto-cols-[minmax(min-content,max-content)] gap-x-2']) }}
  >
    @foreach ($stages as $pet)
      <div class="row-start-1 flex flex-1 justify-center">
        <a
          class="self-center"
          href="{{ $pet->creature->direct_link }}"
        >
          <img
            class="creature-image self-center"
            src="{{ $pet->image_link }}"
            alt="{{ $pet->creature->name }}"
          />
        </a>
      </div>
      <span
        class="row-start-2 overflow-hidden text-ellipsis whitespace-nowrap text-center">{{ $pet->creature->name }}</span>
      <span class="row-start-2 hidden last:hidden sm:block">&nbsp;</span>
      <span
        class="row-start-1 hidden self-center last:hidden sm:block"
        role="presentation"
        aria-hidden="true"
      >→</span>
    @endforeach
  </div>
</div>

@once
  @push('css')
    <style>
      .evolution:last-child .evolution-arrow {
        display: none;
      }
    </style>
  @endpush
@endonce
