<div class="row">

	<div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.logo") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $project->project_logo ?? null,
                'name' => 'project_logo',
            ])
            @endcomponent
        </div>
    </div>
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.district") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="district" id="district" required class="form-control">
                    <option value="">---</option>
                    @if(isset($districts) && $districts != null)
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ isset($project->district_id) && $project->district_id ==  $district->id ? 'selected' : '' }}>{{  $district->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.tenure") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="tenure" id="tenure" class="form-control">
                    <option value="">---</option>
                    @if(isset($tenures) && $tenures != null)
                    @foreach($tenures as $tenure)
                        <option value="{{ $tenure->id }}" {{ isset($project->tenure_id) && $project->tenure_id ==  $tenure->id ? 'selected' : '' }}>{{  $tenure->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.type") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="type" id="type" class="form-control">
                    <option value="">---</option>
                    @if(isset($types) && $types != null)
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ isset($project->type_id) && $project->type_id ==  $type->id ? 'selected' : '' }}>{{  $type->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.direction") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="direction" id="direction" class="form-control">
                    <option value="">---</option>
                    @if(isset($directions) && $directions != null)
                    @foreach($directions as $direction)
                        <option value="{{ $direction->id }}" {{ isset($project->direction_id) && $project->direction_id ==  $direction->id ? 'selected' : '' }}>{{  $direction->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.purpose") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="purpose" id="purpose" class="form-control">
                    <option value="">---</option>
                    @if(isset($purposes) && $purposes != null)
                    @foreach($purposes as $purpose)
                        <option value="{{ $purpose->id }}" {{ isset($project->purpose_id) && $project->purpose_id ==  $purpose->id ? 'selected' : '' }}>{{  $purpose->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.email") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="email" autocomplete="off"
                       value="{!! !empty($project->email)  ? $project->email : old('email') !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_project.form.project_more_url") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="project_more_url" id="project_more_url" autocomplete="off"
                       value="{!! !empty($project->project_more_url)  ? $project->project_more_url : old('project_more_url') !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_project.form.project_price") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="project_price" id="project_price" autocomplete="off"
                       value="{!! !empty($project->project_price)  ? $project->project_price : old('project_price') !!}">
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.develop") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $project->develop ?? null,
                'name' => 'develop',
            ])
            @endcomponent
        </div>
    </div>

   {{--  <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.watermark") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $project->project_watermark ?? null,
                'name' => 'project_watermark',
            ])
            @endcomponent
        </div>
    </div> --}}

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.phone") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="phone" id="phone" autocomplete="off"
                       value="{!! !empty($project->phone)  ? $project->phone : old('phone') !!}">
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.whatsapp") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="whatsapp" autocomplete="off"
                       value="{!! !empty($project->whatsapp)  ? $project->whatsapp : old('whatsapp') !!}">
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">Near Place (Custom Report)</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="near_place" id="near_place"
                       value="{!! !empty($project->near_place)  ? $project->near_place : old('near_place') !!}">
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($project) && $project->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_project.form.active") !!}</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">Option (Vertical or Horizontal) Logo </div>
        <div class="form-group">
            <input type="checkbox" id="option" name="option"
                   value="1" {!! !empty($project) && $project->option ? "checked" : null !!}>
            <label style="margin-top: 10px" for="option">{!! trans("admin_project.form.active") !!}</label>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-3"></div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.project_lastest_launches") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="project_lastest_launches" name="project_lastest_launches"
                   value="1" {!! !empty($project) && $project->project_lastest_launches ? "checked" : null !!}>
            <label style="margin-top: 10px" for="project_lastest_launches">{!! trans("admin_project.form.project_lastest_launches") !!}</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.project_heavily_discount") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="project_heavily_discount" name="project_heavily_discount"
                   value="1" {!! !empty($project) && $project->project_heavily_discount ? "checked" : null !!}>
            <label style="margin-top: 10px" for="project_heavily_discount">{!! trans("admin_project.form.project_heavily_discount") !!}</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.project_investor") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="project_investor" name="project_investor"
                   value="1" {!! !empty($project) && $project->project_investor ? "checked" : null !!}>
            <label style="margin-top: 10px" for="project_investor">{!! trans("admin_project.form.project_investor") !!}</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.background") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $project->project_background_section ?? null,
                'name' => 'project_background_section',
            ])
            @endcomponent
        </div>
    </div>


    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.project_mear_mrt") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="project_mear_mrt" name="project_mear_mrt"
                   value="1" {!! !empty($project) && $project->project_mear_mrt ? "checked" : null !!}>
            <label style="margin-top: 10px" for="project_mear_mrt">{!! trans("admin_project.form.project_mear_mrt") !!}</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.freehold") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="freehold" name="freehold"
                   value="1" {!! !empty($project) && $project->freehold ? "checked" : null !!}>
            <label style="margin-top: 10px" for="freehold">{!! trans("admin_project.form.freehold") !!}</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.project_star_buy") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="star_buy" name="star_buy"
                   value="1" {!! !empty($project) && $project->star_buy ? "checked" : null !!}>
            <label style="margin-top: 10px" for="star_buy">{!! trans("admin_project.form.star_buy") !!}</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">Position</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="position" id="position" min="0"
                       value="{!! !empty($project) ? $project->position : 0 !!}">
            </div>
        </div>
    </div>

   {{--  <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.facebook") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="facebook" autocomplete="off"
                       value="{!! !empty($project->facebook)  ? $project->facebook : old('facebook') !!}">
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.twitter") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="twitter" autocomplete="off"
                       value="{!! !empty($project->twitter)  ? $project->twitter : old('twitter') !!}">
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.linkedin") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="linkedin" autocomplete="off"
                       value="{!! !empty($project->linkedin)  ? $project->linkedin : old('linkedin') !!}">
            </div>
        </div>
    </div> --}}

    <div class="clearfix"></div>
{{-- 
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.background") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $project->project_background_section ?? null,
                'name' => 'project_background_section',
            ])
            @endcomponent
        </div>
    </div> --}}

    <div class="col-md-3" style="display: none">
        <div class="font-bold col-green">{!! trans("admin_project.form.link_backup") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="link_backup" autocomplete="off"
                       value="{!! !empty($project->link_backup)  ? $project->link_backup : old('link_backup') !!}">
            </div>
        </div>
    </div>
    
    <div class="col-md-3 rating-project" style="display: none">
        <div class="font-bold col-green">{!! trans("admin_project.form.estimated_rental_yield") !!}</div>
        <div class="form-group">
            <input type="hidden" name="estimated_rental_yield" class="rating" data-fractions="2" value="{{ (isset($project->estimated_rental_yield) && $project->estimated_rental_yield != null) ? $project->estimated_rental_yield : 0 }}" />
        </div>
    </div>

    <div class="col-md-3 rating-project" style="display: none">
        <div class="font-bold col-green">{!! trans("admin_project.form.estimated_capital_appreciation") !!}</div>
        <div class="form-group">
        <input type="hidden" name="estimated_capital_appreciation" class="rating" data-fractions="2" value="{{ (isset($project->estimated_capital_appreciation) && $project->estimated_capital_appreciation != null) ? $project->estimated_capital_appreciation : 0 }}" />
        </div>
    </div>

    <div class="col-md-3" style="display: none">
        <div class="font-bold col-green">{!! trans("admin_project.form.custom_report") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="custom_report" name="custom_report"
                   value="1" {!! !empty($project) && $project->custom_report ? "checked" : null !!}>
            <label style="margin-top: 10px" for="custom_report">{!! trans("admin_project.form.active") !!}</label>
        </div>
    </div>


</div>
<style>
    .rating-project .glyphicon{ font-size: 20px }
</style>