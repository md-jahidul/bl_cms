<div class="col-md-12">
    <div id="call_to_action_buttons" class="call_to_action_buttons">


        @if( !empty($ecarrer_item->call_to_action) )
            @php
                $all_buttons = unserialize($ecarrer_item->call_to_action);
            @endphp

            @if( !empty($all_buttons) )
                @php $i = 1; @endphp
                <input type="hidden" name="call_to_action_count" value="{{ count($all_buttons) }}">
                @foreach($all_buttons as $buttons)

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="title" class="required1 mr-1">Button label: (Engliash)</label>
                                <input class="form-control" type="text" name="call_to_action_label_en_{{$i}}" value="{{ isset($buttons['label_en']) ? $buttons['label_en'] : '' }}">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="title" class="required1 mr-1">Button label: (Bangla)</label>
                                <input class="form-control" type="text" name="call_to_action_label_bn_{{$i}}" value="{{ isset($buttons['label_bn']) ? $buttons['label_bn'] : '' }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="title" class="required1 mr-1">Button link:</label>
                                <input class="form-control" type="text" name="call_to_action_url_{{$i}}" value="{{ isset($buttons['link']) ? $buttons['link'] : '' }}">
                                <p class="hints"> (For internal link only path, e.g. /e-career And for external full path e.g.  https://eshop.banglalink.net )</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="title" class="required1 mr-1">Button link: (Bangla)</label>
                                <input class="form-control" type="text" name="call_to_action_url_bn_{{$i}}" value="{{ isset($buttons['link_bn']) ? $buttons['link_bn'] : '' }}">
                                <p class="hints"> (For internal link only path, e.g. /e-career And for external full path e.g.  https://eshop.banglalink.net )</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for=""></label>
                            <div class="form-group">
                                <a href="#" class="add_more btn btn-warning btn-glow px-1">+</a>
                            </div>

                        </div>
                    </div>
                    @php $i++; @endphp
                @endforeach

            @endif

        @else

            <input type="hidden" name="call_to_action_count" value="1">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="title" class="required1 mr-1">Button label: (English)</label>
                        <input class="form-control" type="text" name="call_to_action_label_en_1" value="">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="title" class="required1 mr-1">Button label: (Bangla)</label>
                        <input class="form-control" type="text" name="call_to_action_label_bn_1" value="">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="title" class="required1 mr-1">Button link:</label>
                        <input class="form-control" type="text" name="call_to_action_url_1" value="">
                        <p class="hints"> (For internal link only path, e.g. /e-career And for external full path e.g.  https://eshop.banglalink.net )</p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="title" class="required1 mr-1">Button link: (Bangla)</label>
                        <input class="form-control" type="text" name="call_to_action_url_bn_1" value="">
                        <p class="hints"> (For internal link only path, e.g. /e-career And for external full path e.g.  https://eshop.banglalink.net )</p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for=""></label>
                    <div class="form-group">
                        <a href="#" class="add_more btn btn-warning btn-glow px-1">+</a>
                    </div>

                </div>
            </div>

        @endif

    </div>
</div>


@push('page-js')

<script type="text/javascript">

    jQuery(document).ready(function($){

        $('#call_to_action_buttons').on('click', 'a.add_more', function(e){
            e.preventDefault();

            var itemCount = parseInt($('#call_to_action_buttons input[name="call_to_action_count"]').val(), 10);
            var itemCountAdd = (itemCount + 1);

            var $html = '';

            $html += `<div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="title" class="required mr-1">Button label:</label>
                                <input class="form-control" type="text" name="call_to_action_label_en_${itemCountAdd}" value="">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="title" class="required1 mr-1">Button label: (Bangla)</label>
                                <input class="form-control" type="text" name="call_to_action_label_bn_${itemCountAdd}" value="">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="title" class="required mr-1">Button link:</label>
                                <input class="form-control" type="text" name="call_to_action_url_${itemCountAdd}" value="">
                                <p class="hints"> (For internal link only path, e.g. /e-career And for external full path e.g.  https://eshop.banglalink.net )</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="title" class="required mr-1">Button link: (Bangla)</label>
                                <input class="form-control" type="text" name="call_to_action_url_bn_${itemCountAdd}" value="">
                                <p class="hints"> (For internal link only path, e.g. /e-career And for external full path e.g.  https://eshop.banglalink.net )</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for=""></label>
                            <div class="form-group">
                                <a href="#" class="btn btn-warning btn-glow px-1 add_more">+</a>
                                <a href="#" class="btn btn-danger btn-glow px-1 btn_remove">-</a>
                            </div>
                        </div>
                    </div>`;

            $('#call_to_action_buttons').append($html);

            $('#call_to_action_buttons input[name="call_to_action_count"]').val(itemCountAdd);

        });


        $('#call_to_action_buttons').on('click', 'a.btn_remove', function(e){
            e.preventDefault();

            var itemCount = parseInt($('#call_to_action_buttons input[name="call_to_action_count"]').val(), 10);
            // var itemCountAdd = (itemCount - 1);

            $(this).closest('.row').remove();

            // $('#call_to_action_buttons input[name="call_to_action_count"]').val(itemCountAdd);

        });

    });

</script>

@endpush
