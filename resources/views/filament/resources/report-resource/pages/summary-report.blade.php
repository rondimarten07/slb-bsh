<x-filament-panels::page>
  <h1>Summary Report</h1>
  @foreach ($reports as $report)
    <div class="columns-2">
      <p class="col-2"> {{ $report->date }} </p>
      <p class="col-10"> {{ $report->note }} </p>
    </div>
  @endforeach
</x-filament-panels::page>
