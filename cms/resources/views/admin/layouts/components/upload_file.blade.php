<div class="ckfinder-upload">
    <div class="out-image {{ $file ? '' : 'hidden' }}">
        <img src="/images/pdf.svg">
        <input type="hidden" value="{!!  $file ?? null  !!}" name="{{ $name ?? null }}" class="uploadPdf">
        <div class="info-file"></div>
        <button type="button" class="btn btn-danger btn-circle btn-delete">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>

    <div class="box-upload {{ $file ? 'hidden' : '' }}">
        <label class="label-select">
            <span class="glyphicon glyphicon-picture"></span>
        </label>
        <button type="button" class="btn-ckfinder ckfinder-upload-file"></button>
    </div>
</div>

