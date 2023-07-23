<div>
    <div {{ $attributes->merge(['class' => 'grid flex-row items-stretch auto-cols-[minmax(min-content,max-content)] gap-x-2']) }}>
        @foreach ($stages as $pet)
            <div class="flex justify-center flex-1 row-start-1">
                <a class='self-center' href="{{ route('creatures.family.creature.show', [$pet->creature->family->name, $pet->creature->name]) }}">
                <img src='{{ $pet->imageLink() }}'
                    alt="{{ $pet->creature->name }}"
                    class='self-center creature-image' />
                </a>
            </div>
            <span class="row-start-2 text-center text-ellipsis overflow-hidden whitespace-nowrap">{{ $pet->creature->name }}</span>
            <span class="hidden row-start-2 sm:block last:hidden">&nbsp;</span>
            <span aria-hidden="true" role="presentation" class="hidden row-start-1 self-center sm:block last:hidden">→</span>
        @endforeach
    </div>
</div>

@once
    @push('css')
<style>
.evolution:last-child .evolution-arrow{
    display: none;
}
</style>
    @endpush
@endonce
