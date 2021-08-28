@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.project.datatable') }}"/>
@endsection

@section("style")
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-rating.css">
    <style>
        .bootstrap-tagsinput .tag {
            font-size: 13px;
        }
        .bootstrap-tagsinput .label-info {
            background-color: #4caf50;
        }
        a.mo-rong, a.thu-gon{ display: block; text-align: center; text-decoration: none }
    </style>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                @include('admin.layouts.partials.message')

                @component('admin.layouts.components.form', [
                    'form_method' =>  empty($project) ? 'POST' : 'PUT',
                    'form_url' => empty($project) ? route("admin.project.store") : route("admin.project.update", $project->id)
                ])
                    <!-- Nav tabs -->
                        @include('admin.translation.nav_tab', [
                            'default_tabs' => [
                                [
                                    'id' => 'general',
                                    'name' => trans('admin_tab.general'),
                                    'path' => 'admin.project.partials.general'
                                ],
                                [
                                    'id' => 'project-location',
                                    'name' => trans('admin_tab.location'),
                                    'path' => 'admin.project.partials.project_location'
                                ],
                                [
                                    'id' => 'project-last-update',
                                    'name' => trans('admin_tab.project_last_update'),
                                    'path' => 'admin.project.partials.project_last_update'
                                ],
                                [
                                    'id' => 'project-slides',
                                    'name' => trans('admin_tab.project_slides'),
                                    'path' => 'admin.project.partials.project_slides'
                                ],
                                [
                                    'id' => 'project-grid',
                                    'name' => trans('admin_tab.project_grid'),
                                    'path' => 'admin.project.partials.project_grid'
                                ],
                                [
                                    'id' => 'project-price',
                                    'name' => trans('admin_tab.project_price'),
                                    'path' => 'admin.project.partials.project_price'
                                ],
                                [
                                    'id' => 'project-floor',
                                    'name' => trans('admin_tab.project_floor'),
                                    'path' => 'admin.project.partials.project_floor'
                                ],
                                [
                                    'id' => 'project-gallery',
                                    'name' => trans('admin_tab.project_gallery'),
                                    'path' => 'admin.project.partials.project_gallery'
                                ],
                            ],
                            'object_trans' => $project ?? null,
                            'default_tab' => 'general',
                            'form_fields' => [
                                ['type' => 'text', 'name' => 'name'],
                                ['type' => 'text', 'name' => 'slug', 'none' => 'disabled'],
                                ['type' => 'text', 'name' => 'project_address'],
                                ['type' => 'text', 'name' => 'tag'],
                                ['type' => 'textarea', 'name' => 'description'],
                                ['type' => 'text', 'name' => 'location_title'],
                                ['type' => 'text', 'name' => 'location_subtitle'],
                                ['type' => 'textarea', 'name' => 'location_description'],
                                ['type' => 'text', 'name' => 'gallery_title'],
                                ['type' => 'text', 'name' => 'gallery_subtitle'],
                                ['type' => 'textarea', 'name' => 'gallery_description'],
                                ['type' => 'text', 'name' => 'project_price_title'],
                                ['type' => 'text', 'name' => 'project_price_subtitle'],
                                ['type' => 'textarea', 'name' => 'project_price_description'],
                                ['type' => 'text', 'name' => 'floorplan_title'],
                                ['type' => 'text', 'name' => 'floorplan_subtitle'],
                                ['type' => 'textarea', 'name' => 'floorplan_description'],
                                ['type' => 'text', 'name' => 'contact_title'],
                                ['type' => 'text', 'name' => 'contact_subtitle'],
                                ['type' => 'textarea', 'name' => 'contact_description'],
                            ],
                            'form_plugins' => ['ckeditor'],
                            'tab_seo' => true,
                            'metadata' => $metadata ?? null,
                            'translation_file' => 'admin_project'
                        ])

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.project.index")
                        ])
                    @endcomponent
                </div>
                <div id="counttab" data-count="1" style="display:none"></div>
                <div class="append-project-price-hidden" style="display: none;">
                    <div id="plus-project-price">
                        <div class="col-md-12">
                            <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
                            <div class="col-md-4">
                            <div class="font-bold col-green">{!! trans("admin_project.form.project_price_images") !!}</div>
                                <div class="form-group">
                                    <div class="ckfinder-upload">
                                        <div class="out-image hidden">
                                            <img src="">
                                            <input type="hidden" value="" name="project_price_images[]">
                                            <div class="info-file"></div>
                                            <button type="button" class="btn btn-danger btn-circle btn-delete">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>

                                        <div class="box-upload ">
                                            <label class="label-select">
                                                <span class="glyphicon glyphicon-picture"></span>
                                            </label>
                                            <button type="button" class="btn-ckfinder"></button>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="font-bold col-green">{!! trans("admin_project.form.project_price_table") !!}</div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="project_price_table[]" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">

                            <ul class="nav nav-tabs tab-nav-right" role="tabpricename">
                                @php $i = 0 @endphp
                                @foreach($composer_locales as $key => $locale)
                                    <li role="presentation" class="{{ ($i == 0) ? 'active' : '' }} tab-{{ $key }} tablocale">
                                        <a href="#tabpricename{{ $key }}" data-toggle="tab" aria-expanded="false" class="tabclick" data-lang="{{ $key }}">
                                            <span class="font-17">{!! trans("admin_translation.tab.{$key}") !!}</span>
                                        </a>
                                    </li>

                                @php $i++; @endphp
                                @endforeach     
                            </ul>

                            <div class="tab-content">
                            @php $i = 0 @endphp
                            @foreach($composer_locales as $key => $locale)
                                <div class="data-price-name-{{ $key }} tab-pane fade {{ ($i == 0) ? 'in active' : '' }} lang-content" id="tabpricename{{ $key }}">
                                    <div class="font-bold col-green">{!! trans("admin_project.form.price_name") !!}</div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="{{ $key }}[price_name_detail][]">
                                        </div>
                                    </div>
                                </div>
                            @php $i++; @endphp
                            @endforeach
                            </div>
                        </div>
      
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                    </div>
                </div>

                <div class="append-project-floor-hidden" style="display: none;">
                    <div id="plus-project-floor">
                        <div class="col-md-12">
                            <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
                            <div class="col-md-4">
                            <div class="font-bold col-green">{!! trans("admin_project.form.project_floor_images") !!}</div>
                                <div class="form-group">
                                    <div class="ckfinder-upload">
                                        <div class="out-image hidden">
                                            <img src="">
                                            <input type="hidden" value="" name="project_floor_images[]">
                                            <div class="info-file"></div>
                                            <button type="button" class="btn btn-danger btn-circle btn-delete">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>

                                        <div class="box-upload ">
                                            <label class="label-select">
                                                <span class="glyphicon glyphicon-picture"></span>
                                            </label>
                                            <button type="button" class="btn-ckfinder"></button>
                                        </div>
                                    </div>          
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="font-bold col-green">PDF</div>
                                <div class="form-group">
                                    @component('admin.layouts.components.upload_file', [
                                        'file' => '',
                                        'name' => 'project_floor_pdf[]',
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                
                            <div class="col-md-4">
                                <div class="font-bold col-green">{!! trans("admin_project.form.floor_category") !!}</div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="floor_category_id[]" class="form-control">
                                            <option value="">---</option>
                                            @if(isset($floor_categories) && $floor_categories != null)
                                            @foreach($floor_categories as $floor_category)
                                                <option value="{{ $floor_category->id }}">{{ $floor_category->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="font-bold col-green">{!! trans("admin_project.form.floor_type") !!}</div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="floor_type_id[]" class="form-control">
                                            <option value="">---</option>
                                            @if(isset($floor_types) && $floor_types != null)
                                                @php 
                                                    category($floor_types,0,'',$check_floor);  
                                                @endphp
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">

                                <ul class="nav nav-tabs tab-nav-right" role="tabfloorname">
                                    @php $i = 0 @endphp
                                    @foreach($composer_locales as $key => $locale)
                                        <li role="presentation" class="{{ ($i == 0) ? 'active' : '' }} tab-{{ $key }} tablocale">
                                            <a href="#tabfloorname{{ $key }}" data-toggle="tab" aria-expanded="false" class="tabclick" data-lang="{{ $key }}">
                                                <span class="font-17">{!! trans("admin_translation.tab.{$key}") !!}</span>
                                            </a>
                                        </li>

                                    @php $i++; @endphp
                                    @endforeach     
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="tab-content">
                                @php $i = 0 @endphp
                                @foreach($composer_locales as $key => $locale)
                                    <div class="data-floor-name-{{ $key }} tab-pane fade {{ ($i == 0) ? 'in active' : '' }} lang-content" id="tabpricename{{ $key }}">
                                        <div class="font-bold col-green">{!! trans("admin_project.form.floor_content") !!}</div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="{{ $key }}[project_floor_content][]" class="form-control ck ck-content-{{ $key }}" id="{{ $key }}_floor_content{{ $i }}" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="font-bold col-green">{!! trans("admin_project.form.floor_unit") !!}</div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="{{ $key }}[project_floor_unit][]" class="form-control ck  ck-unit-{{ $key }}" id="{{ $key }}_floor_unit{{ $i }}" cols="30" rows="10"></textarea>
                                                </div>
                                        </div>
                                    </div>
                                @php $i++; @endphp
                                @endforeach
                            </div>
                        </div>
      
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                    </div>
                </div>

                <!-------------Create Gallery Images--------------->

                {{-- <div class="append-project-gallery-hidden" style="display: none;">
                    <div id="plus-project-gallery">
                        <div class="col-md-4">
                            <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
                            <div class="font-bold col-green">{!! trans("admin_project.form.project_gallery") !!}</div>
                                <div class="form-group">
                                    <div class="ckfinder-upload">
                                        <div class="out-image hidden">
                                            <img src="">
                                            <input type="hidden" value="" name="project_gallery[]">
                                            <div class="info-file"></div>
                                            <button type="button" class="btn btn-danger btn-circle btn-delete">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>

                                        <div class="box-upload ">
                                            <label class="label-select">
                                                <span class="glyphicon glyphicon-picture"></span>
                                            </label>
                                            <button type="button" class="btn-ckfinder"></button>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-------------End Create Gallery--------------->

                <div class="append-project-slides-hidden" style="display: none;">
                    <div id="plus-project-slides">
                        <div class="col-md-4">
                            <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
                            <div class="font-bold col-green">{!! trans("admin_project.form.project_slides") !!}</div>
                                <div class="form-group">
                                    <div class="ckfinder-upload">
                                        <div class="out-image hidden">
                                            <img src="">
                                            <input type="hidden" value="" name="project_slides[]">
                                            <div class="info-file"></div>
                                            <button type="button" class="btn btn-danger btn-circle btn-delete">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>

                                        <div class="box-upload ">
                                            <label class="label-select">
                                                <span class="glyphicon glyphicon-picture"></span>
                                            </label>
                                            <button type="button" class="btn-ckfinder"></button>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="append-last-update-hidden" style="display: none">
                    <div id="plus-project-last-update">
                        <div class="col-md-12">
                            <button class="btn btn-danger pull-right button-remove-update" type="button">Remove</button><br/>

                            <div class="col-md-12">
                                <div class="font-bold col-green">{!! trans("admin_project.form.project_date_update") !!}</div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control datepicker" name="last_update_date[]" autocomplete="off">
                                        <div class="publish_date-container" style="position: relative"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">

                                <ul class="nav nav-tabs tab-nav-right" role="tablastupdate">
                                    @php $i = 0 @endphp
                                    @foreach($composer_locales as $key => $locale)
                                        <li role="presentation" class="{{ ($i == 0) ? 'active' : '' }} tab-{{ $key }} tablocale">
                                            <a href="#tablastupdate{{ $key }}" data-toggle="tab" aria-expanded="false" class="tabclick" data-lang="{{ $key }}">
                                                <span class="font-17">{!! trans("admin_translation.tab.{$key}") !!}</span>
                                            </a>
                                        </li>

                                    @php $i++; @endphp
                                    @endforeach     
                                </ul>

                                <div class="tab-content">
                                @php $i = 0 @endphp
                                @foreach($composer_locales as $key => $locale)
                                    <div class="data-last-update-{{ $key }} tab-pane fade {{ ($i == 0) ? 'in active' : '' }} lang-content" id="tablastupdate{{ $key }}">
                                        <div class="font-bold col-green">{!! trans("admin_project.form.content_update") !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="{{ $key }}[content_update][]">
                                            </div>
                                        </div>
                                    </div>
                                @php $i++; @endphp
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<script>
    $(document).on("click", ".tabclick", function(){
        var lang = $(this).attr("data-lang");
        $(".lang-content").removeClass("in");
        $(".lang-content").removeClass("active");
        $(".tablocale").removeClass("active")
        $(".data-price-name-"+lang).addClass("in");
        $(".data-price-name-"+lang).addClass("active");
        $(".tab-"+lang).addClass("active");
    });
    @php $locales = \Config::get('translatable.locales'); @endphp
    var LANGUAGES = [@php echo '"'.implode('","',  $locales ).'"' @endphp]
</script>

@endsection

@section("script")
    @include("admin.layouts.partials.modal-delete")

    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>
    
    <script type="text/javascript" src="/assets/admin/js/pages/project.create.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-rating.min.js"></script>
    <script src="//maps.googleapis.com/maps/api/js?key={{ \Config::get('key.key_map') }}&amp;libraries=places,geometry,drawing&callback=initMap" async defer></script>
    <script>
    $(document).on('focus', '.datepicker', function(){
      $(this).datepicker({ dateFormat: 'dd/mm/yy' });
    });

    var grectangle = [];
    var gcircles= [];
    var gpolygon = [];

    var btn_clear_all = document.getElementById('delete-all-button');
    

    function onCircleComplete(shape) {
        var circle;
        if (shape == null || (!(shape instanceof google.maps.Circle))) return;

        if (circle != null) {
            circle.setMap(null);
            circle = null;
        }

        circle = shape;
        gcircles.push(circle);
        var circles = circle.getRadius().toString();
        var json = '{"circle":'+circles+', "lat":'+circle.getCenter().lat()+', "lng":'+circle.getCenter().lng()+'}';
        json = json.replace(/\(/g,"[").replace(/\)/g,"]");
        $("#map-shape").val(json);
    }


    function onRectangleComplete(shape) {
        var rectangle;
        if (shape == null || (!(shape instanceof google.maps.Rectangle))) return;

        if (rectangle != null) {
            rectangle.setMap(null);
            rectangle = null;
        }

        rectangle = shape;
        grectangle.push(rectangle);
        var bounds = rectangle.getBounds().toString();
        var json = '{"bounds":'+rectangle.getBounds().toString()+"}";
        json = json.replace(/\(/g,"[").replace(/\)/g,"]");
        $("#map-shape").val(json);
    }

    function onPolygonComplete(shape){
        var polygon;
        if (shape == null || (!(shape instanceof google.maps.Polygon))) return;
        if (polygon != null) {
            polygon.setMap(null);
            polygon = null;
        }

        polygon = shape;
        gpolygon.push(polygon);
        var polygonBounds = polygon.getPath();
        var bounds = [];
        for (var i = 0; i < polygonBounds.length; i++) {
              var point = {
                lat: polygonBounds.getAt(i).lat(),
                lng: polygonBounds.getAt(i).lng()
              };
              bounds.push(point);
         }
        var json = '{"area":'+JSON.stringify(bounds)+"}";
        json = json.replace(/\(/g,"[").replace(/\)/g,"]");
        $("#map-shape").val(json);
    }

    @if(isset($project->map_shape) && $project->map_shape != null)
    function loadPolygons(map) {
        var data = JSON.parse(JSON.stringify({!! $project->map_shape !!}));
        var dataPolygon = data.area;
        var dataCircle = data.circle;

        if(dataPolygon !== undefined){
            map.data.add({geometry: new google.maps.Data.Polygon([dataPolygon])});
        }
        if(dataCircle !== undefined){
        var cityCircle = new google.maps.Circle({
            strokeColor: '#000000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#000000',
            fillOpacity: 0.35,
            map: map,
            center: {'lat': data.lat, 'lng': data.lng},
            radius: parseInt(dataCircle)
          });
        geoCircle = new google.maps.Circle(geoCircleOptions);
        }
    }
    @endif

    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: {{ isset($project->lat) ? $project->lat : '53.431976' }}, lng: {{ isset($project->lng) ? $project->lng : '-2.9617522' }} },
        zoom: 17
      });
      var card = document.getElementById('pac-card');
      var input = document.getElementById('pac-input');
      var types = document.getElementById('type-selector');
      var strictBounds = document.getElementById('strict-bounds-selector');

      //Draw Shape Map
      var drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: google.maps.drawing.OverlayType.POLYGON,
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: ['polygon']
      },
    });
    drawingManager.setMap(map);
    // google.maps.event.addListener(drawingManager, 'circlecomplete', onCircleComplete);
    // google.maps.event.addListener(drawingManager, 'rectanglecomplete', onRectangleComplete);
    google.maps.event.addListener(drawingManager, 'polygoncomplete', onPolygonComplete);
    google.maps.event.addListener(map.data,'click',function(f){
     this.remove(f.feature);
     $("#map_shape").val('');
   });

    google.maps.event.addDomListener(btn_clear_all, 'click', function() {            
        $("#map_shape").val('');
        for (k = 0; k < grectangle.length; k++) {
            grectangle[k].setMap(null);
        }
        for (k = 0; k < gcircles.length; k++) {
            gcircles[k].setMap(null);
        }
        for (k = 0; k < gpolygon.length; k++) {
            gpolygon[k].setMap(null);
        }
    });

      map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      autocomplete.setFields(
          ['address_components', 'geometry', 'icon', 'name']);

      var infowindow = new google.maps.InfoWindow();
      var infowindowContent = document.getElementById('infowindow-content');
      infowindow.setContent(infowindowContent);
      var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29),
        position: new google.maps.LatLng({{ isset($project->lat) ? $project->lat : '53.431976' }}, {{ isset($project->lng) ? $project->lng : '-2.9617522' }}),
        title: '{{ isset($project->location) ? $project->location : null }}'
      });

      @if(isset($project->map_shape) && $project->map_shape != null)
      loadPolygons(map);
      @endif

      autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          window.alert("No details available for input: '" + place.name + "'");
          return;
        }

        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);  
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
          address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }

        var lat = place.geometry.location.lat(), lng = place.geometry.location.lng();

        $("#lat-location").val(lat);
        $("#lng-location").val(lng);

        infowindowContent.children['place-icon'].src = place.icon;
        infowindowContent.children['place-name'].textContent = place.name;
        infowindowContent.children['place-address'].textContent = address;
        infowindow.open(map, marker);
      });
    } 
    </script>

@endsection
