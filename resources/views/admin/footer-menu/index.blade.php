@extends('layouts.admin')
@section('title', 'Tag List')
@section('card_name', 'Footer Menu List')
@section('breadcrumb')
    @php

        $liHtml = '<li class="breadcrumb-item"><a href="'. url('footer-menu') .'">Footer Menu</a></li>';
        for($i = count($footer_menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $footer_menu_items[$i]['name']  . '</li>' :
                                  '<li class="breadcrumb-item"><a href="'. url("footer-menu/". $footer_menu_items[$i]["id"] . "/child-footer") .'">' .  $footer_menu_items[$i]['name']  . '</a></li>';
        }
    @endphp
    {!! $liHtml !!}
@endsection
@section('action')
{{--    <a href="{{ url('footer-menu/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Footer Menu--}}
{{--    </a>--}}

@if($parent_id != 0)
    <a href="{{ url("footer-menu/$parent_id/child-footer/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Footer Menu
    </a>
@endif

@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h3 class="menu-title">Dragabble Menu list : lable 1</h3>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <tbody id="sortable">
                        @php($i = 0)
                        @foreach($footerMenus as $footerMenu)
                            @php($i++)
                            <tr data-index="{{ $footerMenu->id }}" data-position="{{ $footerMenu->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $footerMenu->en_label_text  }} {!! $footerMenu->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td class="action" width="20%">
                                    <a href="{{ url('footer-menu/'.$footerMenu->id.'/edit') }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $footerMenu->id }}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                                @if($parent_id == 0)
                                    <td class="text-center" width="10%"><a href="{{ url("footer-menu/$footerMenu->id/child-footer") }}" class="badge bg-success">Child Menus</a></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sortable</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show constrain-movement-container">
                <div class="card-body">
                    <p class="card-text">
                        Drag the header to re-order panels.
                    </p>
                    <div class="jqueryui-ele-container">
                        <div class="accordion-sortable">
                            <div class="group">
                                <h3>Section 1</h3>
                                <div>
                                    <p>
                                        Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque.
                                        Vivamus nisi metus, molestie vel, gravida in, condimentum
                                        sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam
                                        mi. Proin viverra leo ut odio. Curabitur malesuada.
                                        Vestibulum a velit eu ante scelerisque vulputate.
                                    </p>
                                </div>
                            </div>
                            <div class="group">
                                <h3>Section 2</h3>
                                <div>
                                    <p>
                                        Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus
                                        hendrerit, dolor at aliquet laoreet, mauris turpis
                                        porttitor velit, faucibus interdum tellus libero ac
                                        justo. Vivamus non quam. In suscipit faucibus urna.
                                    </p>
                                </div>
                            </div>
                            <div class="group">
                                <h3>Section 3</h3>
                                <div>
                                    <p>
                                        Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus
                                        pellentesque purus in massa. Aenean in pede. Phasellus
                                        ac libero ac tellus pellentesque semper. Sed ac felis.
                                        Sed commodo, magna quis lacinia ornare, quam ante aliquam
                                        nisi, eu iaculis leo purus venenatis dui.
                                </div>
                            </div>
                            <div class="group">
                                <h3>Section 4</h3>
                                <div>
                                    <p>
                                        Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada
                                        fames ac turpis egestas. Vestibulum ante ipsum primis
                                        in faucibus orci luctus et ultrices posuere cubilia
                                        Curae; Aenean lacinia mauris vel est.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


<style>
    h3.menu-title{
        font-weight: bold;
    }
    .table tr{
        padding : 10px;
    }
    section .card {
        background: rgba(235, 242, 255, 0.5);
    }
    .card .table th,.card .table td {
        padding: 10px;
        vertical-align: middle;
    }
    .card .table-bordered th,.card .table-bordered td{
        border : 0px;
    }

    .card .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(206, 208, 212, 0.5);
    }

    td.action{
        width: 20%;
        text-align: right;
    }
    .table-striped tbody tr:nth-of-type(even) {
        background-color : rgb(255, 255, 255);
    }

    span.inactive{
        color: red;
        font-size: small;
    }

    .breadcrumb-wrapper ol.breadcrumb{
        margin-left : 20px;
    }

    .breadcrumb-wrapper li, .breadcrumb-wrapper a{
        font-weight : bold;
        font-size : 15px;
    }
</style>


@push('page-js')
    <script>
        $(function(){
            $('.delete_btn').click(function () {
                var id = $(this).attr('data-id');

                console.log(id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#f51c31',
                    cancelButtonColor: '#1fdd4b',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url("footer-menu/$parent_id/destroy") }}/"+id,
                            methods: "get",
                            success: function (res) {
                                console.log(res);

                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url( ($parent_id == 0) ? 'footer-menu' : "/footer-menu/$parent_id/child-footer") }}"
                                }
                            }
                        })
                    }
                })
            })

            $("#sortable" ).sortable({
                update: function( event, ui ) {
                    $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index+1)){
                            $(this).attr('data-position', (index+1)).addClass('update')
                        }
                    });
                    saveNewPositions()
                }
            });

            function saveNewPositions() {
                var positions = [];
                $('.update').each(function () {
                    positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                });

                console.dir(JSON.stringify({
                    update: 1,
                    position: positions
                }) );

                $.ajax({
                    methods: "POST",
                    url:'{{ url('sort-autosave/parent-footer-sort') }}',
                    data: {
                        update: 1,
                        position: positions
                    },
                    success: function(response){
                        console.log('working');
                        console.dir(response);
                    },
                    error : function() {
                        alert('Some problems..');
                    }
                });
            }
        });
    </script>
@endpush





