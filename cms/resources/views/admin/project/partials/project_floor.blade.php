<!-- Show PDF -->
<div class="row">
    <div class="col-md-4">
        <h4>* Select how floor information is displayed</h4>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">How to display PDF</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="show_pdf" class="form-control show_pdf">
                    <option value="0" {{ isset($project) && $project->show_pdf == 0 ? 'selected' : '' }}>1 PDF 1 floor</option>
                    <option value="1" {{ isset($project) && $project->show_pdf == 1 ? 'selected' : '' }}>PDF for all</option>
                </select>
            </div>
        </div>
    </div>
</div>
<!-- End Show PDF -->

<!-- 1PDF for all -->
<h4>* Information all floor</h4>
<div class="row project-floor-all" id="project-floor-all" 
    {{-- style="display: {{ isset($project) && $project->show_pdf == 1 ? 'block' : 'none' }}" --}}
    >
    <div class="col-md-6">
        <div class="font-bold col-green">{!! trans("admin_project.form.project_floor_images") !!} ( 800 pixels X 1135 pixels)</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $project->image_pdf_all ?? null,
                'name' => 'image_pdf_all',
            ])
            @endcomponent
        </div>
    </div>
    <div class="col-md-6">
        <div class="font-bold col-green">PDF</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_file', [
                'file' => $project->pdf_all ?? null,
                'name' => 'pdf_all',
            ])
            @endcomponent
        </div>
        @if(isset($project) && !is_null($project->pdf_all))
            <div>
                <label class="btn btn-success" for="download-pdf-all">
                    <a style="color:#fff" href="{{ isset($project) ? $project->pdf_all : '' }}" download name="download-pdf-all">
                        <i class="material-icons">cloud_download</i>
                        Download
                    </a>
                </label>
                <label class="btn btn-info" for="link-pdf-all">
                    <a style="color:#fff" href="{{ isset($project) ? $project->pdf_all : ''}}" target="blank_" name="link-pdf-all">
                        <i class="material-icons">preview</i> View
                    </a>
                </label>
            </div>
        @endif
    </div>
</div>
<!-- End 1PDF for all -->
<hr>
<!-- 1 PDF 1 Floor  -->
<h4>* Information on each floor</h4>
<div class="row project-floor-more" id="project-floor-more" 
    {{-- style="{{ isset($project) && $project->show_pdf == 0 ? 'display:block' : 'display:none' }}
           {{ !isset($project) ? 'display:block' : ''}}"  --}}
           >
    @php
        function category($data,$parent_id,$str='',$check_floor = [], $floor_type_id = null){
            foreach ($data as $items) {
                if($items->parent_id == $parent_id){
                    if(in_array($items->id, $check_floor)){
                        $disabled = 'disabled';
                    }else{
                        $disabled = null;
                    }
                    if($floor_type_id != null && $floor_type_id == $items->id){
                        $selected = 'selected';
                    }else{
                        $selected = null;
                    }
                    echo "<option value=".$items->id." ".$disabled." ".$selected.">".$str.' '.$items->name."</option>";
                    category($data,$items->id,$str.'----', $check_floor, $floor_type_id);
                }
            }
        }
    @endphp

    <div class="col-md-12">
        <button class="btn btn-primary pull-right add-project-floor" type="button">Add</button>
    </div>

    @if(isset($project_floors) && $project_floors->count() > 0)
    
        @foreach($project_floors as $project_floor)
            <div class="col-md-12">
                <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
                <div class="col-md-4">
                    <div class="font-bold col-green">{!! trans("admin_project.form.project_floor_images") !!} ( 800 pixels X 1135 pixels)</div>
                    <div class="form-group">
                        @component('admin.layouts.components.upload_photo', [
                            'image' => $project_floor->image ?? null,
                            'name' => 'project_floor_images[]',
                        ])
                        @endcomponent
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="font-bold col-green">PDF</div>
                    <div class="form-group">
                        @component('admin.layouts.components.upload_file', [
                            'file' => $project_floor->pdf ?? null,
                            'name' => 'project_floor_pdf[]',
                        ])
                        @endcomponent
                    </div>
                    @if(!is_null($project_floor->pdf))
                        <div>
                            <label class="btn btn-success" for="download-pdf-{{ $project_floor->id }}">
                                <a style="color:#fff" href="{{ $project_floor->pdf }}" download name="download-pdf-{{ $project_floor->id }}">
                                    <i class="material-icons">cloud_download</i>
                                    Download
                                </a>
                            </label>
                            <label class="btn btn-info" for="link-pdf-{{ $project_floor->id }}">
                                <a style="color:#fff" href="{{ $project_floor->pdf }}" target="blank_">
                                    <i class="material-icons">preview</i> View
                                </a>
                            </label>
                        </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="font-bold col-green">{!! trans("admin_project.form.floor_category") !!}</div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <select name="floor_category_id[]" class="form-control">
                                <option value="">---</option>
                                @if(isset($floor_categories) && $floor_categories != null)
                                @foreach($floor_categories as $floor_category)
                                    <option value="{{ $floor_category->id }}" @if($floor_category->id == $project_floor->floor_category_id) selected @endif>{{ $floor_category->name }}</option>
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
                                    category($floor_types,0,'',$check_floor, $project_floor->floor_type_id);  
                                @endphp
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div><a class="mo-rong" href="javascript:void(0)">View More</a></div>
                <div class="content-floor" style="transition: opacity 1s ease-out; opacity: 0; height: 0; overflow: hidden;">
                    <div><a class="thu-gon" href="javascript:void(0)">Collapse</a></div>
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

                    <div class="tab-content">
                    @php $i = 0 @endphp
                    @foreach($composer_locales as $key => $locale)
                        <div class="data-floor-name-{{ $key }} tab-pane fade {{ ($i == 0) ? 'in active' : '' }} lang-content" id="tabfloorname{{ $key }}">
                            <div class="font-bold col-green">{!! trans("admin_project.form.floor_content") !!}</div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="{{ $key }}[project_floor_content][]" class="form-control ck" id="{{ $key }}_floor_content_{{ $project_floor->id }}" cols="30" rows="10">{{ $project_floor->{"content:{$key}"} }}</textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="font-bold col-green">{!! trans("admin_project.form.floor_unit") !!}</div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="{{ $key }}[project_floor_unit][]" class="form-control ck" id="{{ $key }}_floor_unit_{{ $project_floor->id }}" cols="30" rows="10">{{ $project_floor->{"unit:{$key}"} }}</textarea>
                                </div>
                            </div>
                        </div>
                    @php $i++; @endphp
                    @endforeach
                    </div>
                </div>
            </div>
            <input type="hidden" name="project_update[]" value="{{ $project_floor->id }}">
            <hr>
            </div>
            <div class="clearfix"></div>
        @endforeach
    @else
        <div class="col-md-12">
            <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
            <div class="col-md-4">
                <div class="font-bold col-green">{!! trans("admin_project.form.project_floor_images") !!} ( 800 pixels X 1135 pixels)</div>
                <div class="form-group">
                    @component('admin.layouts.components.upload_photo', [
                        'image' => '',
                        'name' => 'project_floor_images[]',
                    ])
                    @endcomponent
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
            <div class="mo-rong"><a href="javascript:void(0)">View More</a></div>
            <div class="content-floor" style="transition: opacity 1s ease-out; opacity: 0; height: 0; overflow: hidden;">
                <div class="thu-gon"><a href="javascript:void(0)">Collapse</a></div>
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

                <div class="tab-content">
                @php $i = 0 @endphp
                @foreach($composer_locales as $key => $locale)
                    <div class="data-floor-name-{{ $key }} tab-pane fade {{ ($i == 0) ? 'in active' : '' }} lang-content" id="tabfloorname{{ $key }}">
                        <div class="font-bold col-green">{!! trans("admin_project.form.floor_content") !!}</div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea name="{{ $key }}[project_floor_content][]" class="form-control ck" id="{{ $key }}_floor_content" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="font-bold col-green">{!! trans("admin_project.form.floor_unit") !!}</div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea name="{{ $key }}[project_floor_unit][]" class="form-control ck" id="{{ $key }}_floor_unit" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                @php $i++; @endphp
                @endforeach
                </div>
               
            </div>
        </div>
        <hr>
        </div>
        <div class="clearfix"></div>
    @endif

</div>
<!-- End 1 PDF 1 Floor -->

<!-- script -->
<script type="text/javascript" src="/assets/plugins/ckeditor/ckeditor.js?v=0.1"></script>
<script>

	$("#project-floor-more textarea.ck").each(function () {
        if (!$(this).hasClass('ckeditor')) {
            installCkeditorCustom(this);
            $(this).addClass('ckeditor');
        }
    });

    $(".mo-rong").click(function(){
        $(this).css({"display":"none"});
        $(this).parent().parent().find(".content-floor").css({"height":"auto", "opacity":"1", "transition":"opacity 1s ease-out"});
    });

    $(".thu-gon").click(function(){
        $(this).parent().parent().parent().find(".mo-rong").css({"display":"block"});
        $(this).parent().parent().css({"transition":"opacity 1s ease-out","opacity":"0","height":"0","overflow":"hidden"});
    });

    jQuery(function($){

        // $('.show_pdf').on('change', function(){
        //     let number = $(this).find(":selected").val();
        //     if(number === "0"){
        //         $('.project-floor-more').show();
        //         $('.project-floor-all').hide();
        //     } else {
        //         $('.project-floor-more').hide();
        //         $('.project-floor-all').show();
        //     }
        // });

    });

</script>
<!-- End script -->

