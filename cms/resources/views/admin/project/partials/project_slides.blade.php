<div class="row" id="project-slides-more">
    @php 
        $project_slides = [];
    @endphp
    @if(isset($project->project_slides) && $project->project_slides != null)
    @php 
        $project_slides = json_decode($project->project_slides);
    @endphp
    @endif
    <div class="col-md-12">
        <button class="btn btn-primary pull-right add-project-slides" type="button">Add</button>
    </div>
	
    @if(count($project_slides) > 0)
    @for($i = 0; $i < count($project_slides); $i++)

    @if($i % 3 == 0)
        <div class="clearfix"></div>
    @endif
    
	<div class="col-md-4">
        <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
        <div class="font-bold col-green">{!! trans("admin_project.form.slides") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $project_slides[$i] ?? null,
                'name' => 'project_slides[]',
            ])
            @endcomponent
        </div>
    </div>

    @endfor
    @else

    <div class="col-md-4">
        <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
        <div class="font-bold col-green">{!! trans("admin_project.form.slides") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => null,
                'name' => 'project_slides[]',
            ])
            @endcomponent
        </div>
    </div>

    @endif


</div>