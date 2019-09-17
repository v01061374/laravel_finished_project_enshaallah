<div class="row">
    <table class="table">
        <thead>
        <tr>
            @foreach($columns as $column)
                {!! $column->buildTh() !!}
            @endforeach
        </tr>
        </thead>
        <tbody>

        @foreach($rows as $source)
            <tr>
                @foreach($columns as $column)
                   {!! $column->buildTd($source) !!}
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    @if(
    (method_exists($rows,'total') && optional($rows)->total() === 0) ||
    (method_exists($rows,'count') && optional($rows)->count() === 0) ||
    (is_array($rows) && count($rows) === 0)
    )

        <div class="text-center bg-white pt-5 pb-5 w-full">
            <h3 class="font-thin">
                <i class="{{ $iconNotFound }} block m-b"></i>
                {!!  $textNotFound !!}
            </h3>

            {!! $subNotFound !!}
        </div>

    @endif


    @includeWhen($rows instanceof \Illuminate\Contracts\Pagination\Paginator && $rows->total() > 0,
        'platform::layouts.pagination',
        ['paginator' => $rows]
      )

</div>


