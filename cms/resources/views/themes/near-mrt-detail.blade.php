@extends('frontend.layouts.master')

@push('style')
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')

<main class="wrapper detail-view">
    <div class="page-internal-wrapper">
        <!-- All NEW LAUNCHES DETAIL: FILTER SEARCH FORM-->
        @include("frontend.layouts.partials.search_form")
        <!-- All NEW LAUNCHES DETAIL : CONTENT-->
        <section class="gd-view-section detail-view-mode" style="position:relative">
            <div class="row content-detail"> 
                <!--Detail left-->
                @if(isset($projects) && count($projects) > 0)
                <div class="col-lg-4 col-md-12 content-left">   
                    <!--Group control-->
                    <div class="grid-control">
                        <div class="filter-form form-sort">
                            <div class="sort-group">
                                <label class="font-weight-700">Sort by</label>
                                <form method="get" id="form-sort">
                                    <input type="hidden" name="sort" value="{{ request()->get('sort') }}" id="sort">
                                    <div class="tenue">
                                        <div class="nl-dropbox">
                                            <div class="nl-select bordering">Name
                                            </div>
                                            <div class="nl-droplist">
                                                <div class="droplist-container">
                                                    <div class="droplist-content scroll-ui">
                                                        <div class="item-value sort-by @if(request()->get('sort') == 'asc') choosing @endif" data-value="A-Z">A - Z</div>
                                                        <div class="item-value sort-by @if(request()->get('sort') == 'desc') choosing @endif" data-value="Z-A">Z - A</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="view-control-group"><a class="btn-grid" href="{{ getPageUrlByCode('NEAR-MRT') }}">Grid </a><a class="btn-detail active" href="{{ getPageUrlByCode('NEAR-MRT-DETAILED') }}"> Detailed</a></div>
                        </div>
                    </div>
                    <!--List project-->
                    <!-- dat scroll ui o content view-->
                    <div class="nl-content-view"> 
                        <div class="row gutter-20" id="project-list-detailed">
                            
                            @if(isset($projects) && count($projects) > 0)
                            @php $i = 0 @endphp
                            @foreach($projects as $project)
                                <div class="col-xl-6 item-detail @if($i == 0 ) active @endif">
                                    <div class="nl-grid-item current-item">
                                        <div class="img">

                                            <div class="owl-carousel">
                                                @if($project->project_slides != null)
                                                    @php 
                                                        $slides = json_decode($project->project_slides); 
                                                    @endphp
                                                    @if(count($slides) > 0)
                                                        @foreach($slides as $slide)
                                                        <div class="img-item">
                                                            <a class="img-bg owl-lazy" href="javascript:void(0)" data-src="{{ $slide }}"></a>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                        <input type="hidden" value="{{ $project->id }}">
                                        <div class="info">
                                            <h3 class="title font-weight-700"><a href="javascript:void(0)">{{ (isset($project->name) && $project->name != null) ? $project->name : null }}</a></h3>
                                            <div class="desc">{{ (isset($project->description) && $project->description != null) ? $project->description : null }}</div>
                                            <div class="logo">
                                                <div class="img-bg" style="background-image:url('{{ (isset($project->develop) && $project->develop != null) ? asset($project->develop) : null }}')"><img src="{{ (isset($project->develop) && $project->develop != null) ? asset($project->develop) : null }}" alt="{{ (isset($project->name) && $project->name != null) ? $project->name : null }}"></div>
                                            </div>
                                        </div>
                                        <div class="link break-like">
                                            <div class="link-item"><i class="icon icon-marker"></i><span>{{ $project->district_name }}</span></div>
                                            <div class="link-item"><i class="icon icon-paper"></i><span>{{ $project->tenure_name }}</span></div>
                                            <div class="link-item btn-like" data-project="{{ $project->id }}"><i class="icon icon-heart"></i><span class="l1">Project Saved</span><span class="l2">Add to Favourite</span></div>
                                        </div>
                                        @if($project->tag != null)
                                        <div class="tag">
                                            @if(count($tags = explode(',',$project->tag)))
                                                @foreach($tags as $key => $tag)
                                                <span>{{ $tag }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                        @endif
                                        <div class="share"><a class="whatapps" href="https://wa.me/{{ (isset($project->whatsapp) && $project->whatsapp != null) ? $project->whatsapp : NULL }}"><i class="icon icon-hotline"></i></a>
                                            <div class="share-btn">
                                                <div class="icon-share-white"> 
                                                    <div class="open-share">
                                                        <div class="group-share" data-json="{&quot;id&quot;:&quot;{{ $project->id }}&quot;, &quot;url&quot;: {&quot;fbLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;, &quot;twLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;, &quot;lindLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;}}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php $i++ @endphp
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <input type="hidden" id="load-limit" value="{{ $count_projects }}">
                    @if($count_projects > 1)
                    <button class="btn-nlp btn-block blue" id="btn-load-more" type="button" data-load="1">Load More</button>
                    @endif
                </div>
                <!--Detail right-->
                @if(isset($projects) && count($projects) > 0)
                <div class="content-grid-detail col-lg-8 col-md-12" style="background-image: url({{ $projects[0]->project_background_section }})">
                    <div class="dark-layer"></div>
                    <div class="content-right">
                        <div class="name-project">{{ (isset($projects[0]->name) && $projects[0]->name != null) ? $projects[0]->name : null }}</div>
                        <div class="info">
                            <div class="state-proj">Lasted update</div>
                            
                            <div id="last-update">
                            @if(isset($project_last_update) && count($project_last_update) > 0)
                                @foreach($project_last_update as $last_update)
                                <div class="timeline">
                                    <div class="date">{{ (isset($last_update->date) && $last_update->date != null) ? $last_update->date : null }}</div>
                                    <p>{!! (isset($last_update->content) && $last_update->content != null) ? $last_update->content : null !!}</p>
                                </div>
                                @endforeach
                            @endif
                            </div>

                            <div class="timeline">
                                <div class="unit-sold">Units Sold in Feburary</div>
                                <p>
                                    <marquee onmouseover="this.stop();" onmouseout="this.start();">{{ $project->project_more_url }} </marquee>
                                </p>
                            </div>
                        </div><a class="btn-nlp blue" id="view-detail" href="{{ route('frontend.project.detail', ['slug' => $projects[0]->slug]) }}">Enter Project Page </a>
                    </div>
                </div>
                <div class="group-btn">
                    <button class="btn-favorite" type="button" data-project="{{ $projects[0]->id }}"> 
                        <div class="l1">Favourite</div>
                        <div class="l2">Favourite</div>
                    </button>
                </div>
                @endif
                @else
                    <div class="col-lg-12 col-md-12 text-center" style="margin: 20px"> No Results </div>
                @endif
            </div>
        </section>
    </div>
</main>

<style>
#last-update .timeline:last-child{ margin-top: 0; }
</style>
@endsection

@push('script')
<script src="{{ asset('assets/js/library.js') }}"></script>
<script async src="{{ asset('assets/js/pages.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-cookie.min.js') }}"></script>
<script>
    $(".detail-view-mode").on("click", ".item-detail", function(){
        if(!$(this).find(".item-detail").hasClass("active")){
            var data = $(this).find("input").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: '{{ route('project.detail.info.post') }}',
                data: {
                    data: data
                },
                dataType: 'json',
                success:function(reponse){
                    var link = '{{ route('frontend.project.detail', ['slug' => ':slug']) }}';
                    var html = '';
                    link = link.replace(':slug', reponse['project'].slug);
                    $(".name-project").html(reponse['project'].name);
                    $(".content-grid-detail").css({"background-image":"url("+reponse['project'].project_background_section+")"});
                    $("a#view-detail").attr("href", link);
                    $("marquee").html(reponse['project'].project_more_url);
                    $(".btn-favorite").attr("data-project", reponse['project'].id);
                    var favorite = [];
                    var cookie = $.cookie("project");
                    if($.cookie("project") !== undefined && $.cookie("project") !== null && $.cookie("project")){
                        favorite = JSON.parse($.cookie("project"));
                    }
                    if (favorite) {
                        if(jQuery.inArray((reponse['project'].id).toString(), favorite) != -1 ){
                            if(!$(".btn-favorite").hasClass('added')){
                                $(".btn-favorite").addClass('added');
                            }
                        }else{
                            if($(".btn-favorite").hasClass('added')){
                                $(".btn-favorite").removeClass('added');
                            }
                        }
                    }
                    var last_updates = reponse['project_last_update'].data;
                    if(last_updates.length > 0){
                        last_updates.forEach(function(item) {
                            html += '<div class="timeline">';
                            html += '<div class="date">'
                            if(item.date !== null){
                                html += item.date;
                            }
                            html +='</div>';
                            html += '<p>';
                            if(item.content !== null){
                                html += item.content;
                            }
                            html += '</p>';
                            html += '</div>';
                        });
                        $("#last-update").html(html);
                    }else{
                        $("#last-update").empty();
                    }
                }
            });
        }
    });

    $("#btn-load-more").click(function(){
        var take = $(this).attr("data-load");
        if($.cookie("project") !== undefined && $.cookie("project") !== null && $.cookie("project")){
            favorite = JSON.parse($.cookie("project"));
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url: '{{ route('project.near.load.more') }}',
            data: {
                take: take
            },
            dataType: 'json',
            success:function(reponse){
                var list = '';
                if(reponse.length > 0){
                    reponse.forEach(function(project){
                        var link = '{{ route('frontend.project.detail', ['slug' => ':slug']) }}';
                        link = link.replace(':slug', project.slug);
                        if(!project.project_slides){
                            var project_slides = '';
                        }else{
                            var project_slides = JSON.parse(project.project_slides);
                        }
                        list += '<div class="col-xl-6 item-detail">';
                        list += '<div class="nl-grid-item current-item">';
                        list += '<div class="img">';
                        list += '<div class="owl-carousel">'
                        if(project_slides.length > 0){
                            project_slides.forEach(function(slide){
                                list += '<div class="img-item">';
                                list += '<a class="img-bg owl-lazy" href="javascript:void(0)" data-src="'+slide+'"></a>';
                                list += '</div>';
                            });
                        }
                        list += '</div>';
                        list += '</div>';
                        list += '<input type="hidden" value="'+project.id+'">';
                        list += '<div class="info">';
                        list += '<h3 class="title font-weight-700"><a href="javascript:void(0)">'+project.name+'</a></h3>';
                        list += '<div class="desc">';
                        if(project.description !== null){
                            list += project.description
                        }
                        list += '</div>';
                        list += '<div class="logo"><div class="img-bg" style="background-image:url('+project.project_logo+')"> <img src="'+project.project_logo+'" alt="'+project.name+'"> </div></div>';
                        list += '</div>';
                        list += '<div class="link break-like">';
                        list += '<div class="link-item"><i class="icon icon-marker"></i><span>'+project.district_name+'</span></div>';
                        list += '<div class="link-item"><i class="icon icon-paper"></i><span>'+project.tenure_name+'</span></div>';
                        list += '<div class="link-item btn-like ' + ((jQuery.inArray((project.id).toString(), favorite) == -1) ? '' : 'added') + '" data-project="' + project.id + '"><i class="icon icon-heart"></i><span class="l1">Project Saved</span><span class="l2">Add to Favourite</span></div>';
                        list += '</div>';
                        if(project.tag){
                            list += '<div class="tag">';
                            var tags = project.tag.split(',');
                            if(tags.length > 0){
                                tags.forEach( function(tag){
                                   list += '<span>'+tag+'</span>';
                                });
                            }
                            list += '</div>';
                        }
                        list += '<div class="share"><a class="whatapps" href="https://wa.me/'+project.whatsapp+'"><i class="icon icon-hotline"></i></a>';
                        list += '<div class="share-btn">';
                        list += '<div class="icon-share-white">';
                        list += '<div class="open-share">';
                        list += '<div class="group-share" data-json="{&quot;id&quot;:&quot;'+project.id+'&quot;, &quot;url&quot;: {&quot;fbLink&quot;:&quot;'+link+'&quot;, &quot;twLink&quot;:&quot;'+link+'&quot;, &quot;lindLink&quot;:&quot;'+link+'&quot;}}"></div>';
                        list += '</div>';
                        list += '</div>';
                        list += '</div>';
                        list += '</div>';
                        list += '</div>';
                        list += '</div>';
                    });
                    $("#project-list-detailed").append(list);
                    nl_grid_item();
                    allnewlaunches_detail_item_click();
                }
            }
        });
        var next_take = parseInt(take) + 1;
        $(this).attr("data-load", next_take);
        if(next_take == $("#load-limit").val()){
            $(this).remove();
        }
    });
</script>
<script>
    $(".sort-by").on('click', function(){
        var sort = $(this).data('value');
        if(sort == 'A-Z'){
            $('#sort').val('asc');
        }
        if(sort == 'Z-A'){
            $('#sort').val('desc');
        }
        $("#form-sort").submit();
    });
</script>         
@endpush