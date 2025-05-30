<x-page :page='$page'>
    <section>
        <h1>Components</h1>
        <ul>
            @foreach ($components as $componentCategory => $componentList)
                <li>
                    <x-content-section :title='$componentCategory'>
                        <ol class="grid grid-cols-[repeat(auto-fill,minmax(6rem,1fr))] gap-5">
                            @foreach ($componentList as $component)
                                <li class="text-center flex flex-col items-center font-semibold gap-3">
                                  <div class="flex-1 content-center">
                                      <img src="{{ $component->image_link }}" alt="" />
                                  </div>
                                  {{ $component->name }}
                                </li>
                            @endforeach
                        </ol>
                    </x-content-section>
                </li>
            @endforeach
        </ul>
    </section>
</x-page>
