<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-bottom mt-5">    
    <a class="navbar-brand mx-auto" href="{{ url('/') }}">        
        {{ config('app.name', 'Laravel') }}
    </a>
    <label class="navbar-brand mx-auto">
            <a href="{{ route('tokuteis.tokutei', ['id' => 1]) }}">特定商取引法</a>
    </label>
</nav>