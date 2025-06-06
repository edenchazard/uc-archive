<x-page>
  <section class="max-w-prose">
    <h1>Unicreatures Archive</h1>
    <p>Unicreatures was a former adoptables site from 2009 to 2016. This site aims to be a partial archive
      of the
      content.</p>
    <h2>I have missing content!</h2>
    <p>Most content is lost to time, so if you have any missing content, please consider contributing to
      the
      archive.</p>
  </section>
  <section class="mt-2">
    <h2>Archives</h2>
    <ol class="flex list-inside list-disc flex-col gap-2">
      <li><a href="{{ route('creatures.index') }}">Families</a> (image-heavy)</li>
      <li><a href="{{ route('components.index') }}">Components</a></li>
      <li><a href="{{ route('exploration.index') }}">Exploration Areas</a></li>
      <li><a href="{{ route('shop.index') }}">Shop Categories</a></li>
    </ol>
  </section>
</x-page>
