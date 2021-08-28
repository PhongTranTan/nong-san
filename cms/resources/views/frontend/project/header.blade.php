<!-- NAVIGATION SIDEBAR LEFT-->
<div class="pdetail-sidebar"><a href="{{ getPageUrlByCode('ALL-PROJECTS') }}" class="go-back">Back</a><a class="mobile-close-nav"></a>
    <div class="scroll-ui">
        <div class="wrap-scroll-ui">
            <div class="logo-brand @if(isset($project->option) && $project->option == 1) vertical @else horizontal @endif"><a class="img-bg" href="{{ route('frontend.project.detail', ['slug' => $project->slug]) }}#intro" style="background-image:url(@yield('logo-project'))"><img src="@yield('logo-project')" alt=""></a></div>
            <div class="u-center">
                <ul class="navsidebar nav" id="menuFullpage">
                    <li data-menuanchor="feature"><a href="#feature">Project Detail</a></li>
                    <li data-menuanchor="location"><a href="#location"> Location</a></li>
                    <li data-menuanchor="gallery"><a href="#gallery"> Gallery</a></li>
                    <li data-menuanchor="pricing"><a href="#pricing">Pricing</a></li>
                    <li data-menuanchor="floorplan"><a href="#floorplan">Floor plan</a></li>
                    <li data-menuanchor="contact"><a href="#contact">Contact</a></li>
                </ul>
                <button class="btn-nlp btn-light" data-toggle="modal" data-target="#modalProject-detail">Schedule Showflat Tour</button>
            </div>
            <div class="logo-main">
                <div>Powered by</div>
                <a href="{{ url('/') }}">
                    <img src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}">
                </a>
            </div>
        </div>
    </div>
</div>