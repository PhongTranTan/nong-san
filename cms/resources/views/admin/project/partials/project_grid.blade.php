<div class="row">

    @php 
        $grids = [];
    @endphp

    @if(isset($project->project_grid) && $project->project_grid != null)
	@php 
        $grids = json_decode($project->project_grid);
    @endphp
    @endif

	@for($i = 0; $i <= 5; $i++)

    @if($i % 3 == 0)
        <div class="clearfix"></div>
    @endif
    
	<div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_project.form.grid") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $grids[$i] ?? null,
                'name' => 'project_grid[]',
            ])
            @endcomponent
        </div>

        <ul class="nav nav-tabs tab-nav-right" role="tabgrid">
            @php $j = 0 @endphp
            @foreach($composer_locales as $key => $locale)
                @if(isset($project->project_text_grid) && $project->project_text_grid != null)
                @php 
                    $project_text_grid[$key] = json_decode($project->{"project_text_grid:{$key}"});
                @endphp
                @endif
                <li role="presentation" class="{{ ($j == 0) ? 'active' : '' }} tab-{{ $key }} tablocale">
                    <a href="#tabgrid{{ $key }}" data-toggle="tab" aria-expanded="false" class="tabclick" data-lang="{{ $key }}">
                        <span class="font-17">{!! trans("admin_translation.tab.{$key}") !!}</span>
                    </a>
                </li>
            @php $j++; @endphp
            @endforeach     
        </ul>
        <div class="tab-content">
            @php $j = 0 @endphp
            @foreach($composer_locales as $key => $locale)
            <div class="tab-pane fade {{ ($j == 0) ? 'in active' : '' }} lang-content" id="tabgrid{{ $key }}">
                <div class="font-bold col-green">{!! trans("admin_project.form.title") !!}</div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="{{ $key }}[project_title][]" autocomplete="off" value="{{ (isset($project_text_grid[$key]->project_title[$i])) ? $project_text_grid[$key]->project_title[$i] : null }}">
                    </div>
                </div>
                <div class="font-bold col-green">{!! trans("admin_project.form.subtitle") !!}</div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="{{ $key }}[project_subtitle][]" autocomplete="off" value="{{ (isset($project_text_grid[$key]->project_subtitle[$i])) ? $project_text_grid[$key]->project_subtitle[$i] : null }}">
                    </div>
                </div>
            </div>
            @php $j++; @endphp
            @endforeach
        </div>
    </div>
    @endfor

</div>