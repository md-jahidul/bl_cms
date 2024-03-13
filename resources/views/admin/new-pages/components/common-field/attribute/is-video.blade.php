<div class="form-group col-md-12 validate">
    <label for="is_video" class="">Video Preview</label>
    <div class="button_link">
        {{-- {{$component->attribute['is_video']['en']=='on' ?'checked': 'gf'}} --}}
        <input type="checkbox" id="is_video" name="attribute[is_video][en]" class="checkbox"
        @if(isset($component->attribute['is_video']['en']) && $component->attribute['is_video']['en'] == 'on') checked @endif
        />
        <span class="text-primary"> Check here, if you need Video preview</span>
    </div>
</div>