@if(isset($galleries) && count($galleries) > 0)
<div id="create-gallery">
    <button class="btn btn-primary pull-right" type="button" id="btn-create-gallery" data-gallery-add="{{ count($galleries) + 1 }}-add">Create Gallery</button>
</div>

<div class="clearfix"></div>

<div id="show-gallery">
    
    @foreach($galleries as $key_view_gallery => $gallery)
    @php
        $list_images_gallery = json_decode($gallery->images);
    @endphp
    <div class="col-md-3">
        <div id="gallery-{{ $key_view_gallery }}">
            
            <button class="button-remove-gallery" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#modalGallery{{ $key_view_gallery }}">Open Gallery {{ $key_view_gallery + 1 }}</button>

            <div class="modal fade" id="modalGallery{{ $key_view_gallery }}" role="dialog">
                <div class="modal-dialog">
        
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title text-center">Gallery {{ $key_view_gallery + 1 }}</h4>
                        </div>
                        <div class="modal-body">

                            <div class="col-md-6">
                                <div class="font-bold col-green">{!! trans("admin_project.form.gallery.position") !!}</div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="gallery_position[{{ $gallery->id }}]" autocomplete="off" value="{{ (isset($gallery->position)) ? $gallery->position : 0 }}">
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right btn-add-images" type="button" data-add="{{ $gallery->id  }}">Add Images</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12" id="section-gallery{{ $gallery->id }}">
                                
                                <input type="hidden" name="gallery_id[]" value="{{ $gallery->id }}">
                                @if(isset($list_images_gallery) && count($list_images_gallery) > 0)
                                @foreach($list_images_gallery as $key_images => $image_gallery)
                                <div class="col-md-4">
                                    <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
                                    <div class="font-bold col-green">{!! trans("admin_project.form.project_gallery") !!}</div>
                                    <div class="form-group">
                                        @component('admin.layouts.components.upload_photo', [
                                            'image' => $image_gallery ?? null,
                                            'name' => 'project_gallery['.$gallery->id.'][]',
                                        ])
                                        @endcomponent          
                                    </div>

                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
   
</div>
@else
<div id="create-gallery">
    <button class="btn btn-primary pull-right" type="button" id="btn-create-gallery" data-gallery-add="0">Create Gallery</button>
</div>

<div class="clearfix"></div>

<div id="show-gallery">

</div>
@endif
<style>
#show-gallery .modal-dialog{ width: 1200px }
#show-gallery .btn-warning{ font-size: 15px }
#show-gallery .button-remove-gallery .glyphicon{ font-size: 13px; border-radius: 50%; padding: 10px; background: red; }
.button-remove-gallery{ background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none; color: #ffffff; }
</style>