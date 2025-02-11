<div class="card {{ $cardClass ?? 'mt-4' }}">
    <!-- header -->
    <div class="card-header {{ $headerClass ?? 'flex justify-between items-center' }}">
            {{$header}}
    </div>
    <!-- end header -->
    <div class="card-body {{ $bodyClass ?? '' }}">
        {{$slot}}
    </div>

</div>