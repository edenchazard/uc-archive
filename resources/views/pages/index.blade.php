<x-page :data='$page'>
  <section class="max-w-prose">
    <h1>Unicreatures Archive</h1>
    <p>Unicreatures was a former adoptables site from 2009 to 2016. This site aims to be a partial archive of the content.</p>
    <h2>I have missing content!</h2>
    <p>Most content is lost to time, so if you have any missing content, please consider contributing to the archive.</p>
  </section>
  <section>
    <h2>Archives</h2>
    <ol class="flex flex-col gap-3 list-disc list-inside">
      <li><a href="{{ route('creatures.index') }}">Families</a></li>
      <li><a href="{{ route('components.index') }}">Components</a></li>
      <li><a href="{{ route('exploration.index') }}">Exploration Areas</a></li>
    </ol>
  </section>
</x-page>
