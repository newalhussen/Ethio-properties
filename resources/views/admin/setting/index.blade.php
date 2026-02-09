@extends('layouts.admin')
@section('title','Site Settings')
<style>
    #image-preview {
        max-width: 100%;
        max-height: 300px;
    }

    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<?php
$tab = '';
?>
@section('content')


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Settings</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs p-0 mb-3 nav-tabs-success" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home_with_icon_title"> <i class="zmdi zmdi-home"></i> General</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile_with_icon_title"><i class="zmdi zmdi-translate"></i> English </a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages_with_icon_title"><i class="zmdi zmdi-translate"></i> Amharic </a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact_with_icon_title"><i class="zmdi zmdi-info-outline"></i> Contact </a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#head_message"><i class="zmdi zmdi-info-outline"></i> Head </a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane in active" id="home_with_icon_title"> <b>General Settings</b>
                                    @include('layouts.msg')
                                    <form action="{{ route('admin.set.settings') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Site Title</label>
                                                    <input type="text" class="form-control" placeholder="Site Title" name="siteTitle" required value="{{ $setting->siteTitle }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Site Moto</label>
                                                    <input type="text" class="form-control" placeholder="Site Moto" name="SiteMoto" required value="{{ $setting->SiteMoto }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Logo transparent</label>
                                                    <input type="file" class="form-control" id="imgInp" name="logo_transparent" accept="image/jpeg, image/jpg, image/bmp, image/png, image/svg+xml, image/webp">
                                                </div>
                                                <div id="image-preview-container">
                                                    <img src="{{ asset('uploads/Setting/'.$setting->logo_transparent) }}" style="max-width: 100px;" alt="your image" />
                                                </div>
                                                <br>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Logo Big</label>
                                                    <input type="file" class="form-control" id="imgInp1" name="logo_white" accept="image/jpeg, image/jpg, image/bmp, image/png, image/svg+xml, image/webp">
                                                </div>
                                                <div id="image-preview-container">
                                                    <img src="{{ asset('uploads/Setting/'.$setting->logo_white) }}" style="max-width: 100px;" alt="your image" />
                                                </div>
                                                <br>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Logo Footer</label>
                                                    <input type="file" class="form-control" id="imgInp2" name="logo_footer" accept="image/jpeg, image/jpg, image/bmp, image/png, image/svg+xml, image/webp">
                                                </div>
                                                <div id="image-preview-container">
                                                    <img id="blah3" src="{{ asset('uploads/Setting/'.$setting->logo_footer) }}" style="max-width: 100px;" alt="your image" />
                                                </div>
                                                <br>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Favicon</label>
                                                    <input type="file" class="form-control" id="imgInp3" name="favicon" accept="image/jpeg, image/jpg, image/bmp, image/png, image/svg+xml, image/webp">
                                                </div>
                                                <div id="image-preview-container">
                                                    <img id="blah3" src="{{ asset('uploads/Setting/'.$setting->favicon) }}" style="max-width: 100px;" alt="your image" />
                                                </div>
                                                <br>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label>Site keywords</label>
                                                    <textarea name="keywords" required class="form-control">{{ $setting->keywords }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label>Site Description</label>
                                                    <textarea name="sitedescription" required class="form-control">{{ $setting->sitedescription }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">SUBMIT</button>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile_with_icon_title"> <b>English Settings</b>
                                    <form action="{{ route('admin.seten.settings') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Footer Note</label>
                                                    <textarea class="form-control ckeditor" placeholder="Footer Note" name="footer_note" required>{{ $setting->footer_note }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Contact Note</label>
                                                    <textarea class="form-control ckeditor" placeholder="Contact Note" name="contact_note" required>{{ $setting->contact_note }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">About Note</label>
                                                    <textarea class="form-control ckeditor" placeholder="About Note" name="about_note" required>{{ $setting->about_note }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Vision</label>
                                                    <textarea class="form-control ckeditor" placeholder="Vision" name="vision" required>{{ $setting->vision }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Mission</label>
                                                    <textarea class="form-control ckeditor" placeholder="Mission" name="mission" required>{{ $setting->mission }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Objectives</label>
                                                    <textarea class="form-control ckeditor" placeholder="objectives" name="objectives" required>{{ $setting->objectives }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Values</label>
                                                    <textarea class="form-control ckeditor" placeholder="values" name="values" required>{{ $setting->values }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Focuses</label>
                                                    <textarea class="form-control ckeditor" placeholder="Focuses" name="focuses" required>{{ $setting->focuses }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">SUBMIT</button>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="messages_with_icon_title"> <b>Amharic Settings</b>
                                    <form action="{{ route('admin.setam.settings') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Footer Note Am</label>
                                                    <textarea class="form-control ckeditor" placeholder="Footer Note" name="footer_note_am" required>{{ $setting->footer_note_am }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Contact Note Am</label>
                                                    <textarea class="form-control ckeditor" placeholder="Contact Note" name="contact_note_am" required>{{ $setting->contact_note_am }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">About Note Am</label>
                                                    <textarea class="form-control ckeditor" placeholder="About Note" name="about_note_am" required>{{ $setting->about_note_am }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Vision Am</label>
                                                    <textarea class="form-control ckeditor" placeholder="Vision" name="vision_am" required>{{ $setting->vision_am }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Mission Am</label>
                                                    <textarea class="form-control ckeditor" placeholder="Mission" name="mission_am" required>{{ $setting->mission_am }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Objectives Am</label>
                                                    <textarea class="form-control ckeditor" placeholder="objectives" name="objectives_am" required>{{ $setting->objectives_am }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Values Am</label>
                                                    <textarea class="form-control ckeditor" placeholder="values" name="values_am" required>{{ $setting->values_am }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label class="clearfix">Focuses Am</label>
                                                    <textarea class="form-control ckeditor" placeholder="Focuses" name="focuses_am" required>{{ $setting->focuses_am }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">SUBMIT</button>
                                    </form>
                                </div>
                                
<div role="tabpanel" class="tab-pane" id="contact_with_icon_title"> 
    <b>Contact Settings</b>
    <form action="{{ route('admin.set.contactsettings') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Phone</label>
                    <input type="text" class="form-control" placeholder="Phone" name="phone" required value="{{ $setting->phone }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Email No Reply</label>
                    <input type="text" class="form-control" placeholder="Email No Reply" name="emailNoReply" required value="{{ $setting->emailNoReply }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Email Info</label>
                    <input type="text" class="form-control" placeholder="Email Info" name="emailInfo" required value="{{ $setting->emailInfo }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Address" name="address" required value="{{ $setting->address ?? '' }}">
                </div>
            </div>

            <!-- NEW: Working Hours -->
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Working Hours</label>
                    <input type="text" class="form-control" placeholder="e.g. Monday - Friday, 8:00 AM - 6:00 PM" name="working_hours" value="{{ $setting->working_hours ?? '' }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Google Maps Iframe Code</label>
                    <input type="text" class="form-control" placeholder="Google Maps Iframe Code" name="google_map" required value="{{ $setting->google_map }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Facebook</label>
                    <input type="text" class="form-control" placeholder="Facebook" name="facebook" required value="{{ $setting->facebook }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Instagram</label>
                    <input type="text" class="form-control" placeholder="Instagram" name="instagram" required value="{{ $setting->instagram }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>YouTube</label>
                    <input type="text" class="form-control" placeholder="YouTube" name="youtube" required value="{{ $setting->youtube }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Telegram</label>
                    <input type="text" class="form-control" placeholder="Telegram" name="telegram" required value="{{ $setting->telegram }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>Twitter</label>
                    <input type="text" class="form-control" placeholder="Twitter" name="twitter" required value="{{ $setting->twitter }}">
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group form-float">
                    <label>WhatsApp</label>
                    <input type="text" class="form-control" placeholder="WhatsApp" name="whatsapp" required value="{{ $setting->whatsapp }}">
                </div>
            </div>
        </div>
        <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">SUBMIT</button>
    </form>
</div>

                                <div role="tabpanel" class="tab-pane" id="head_message"> <b>Head Message</b>
                                    <form action="{{ route('admin.setmessage.settings') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Head's Full Name in En</label>
                                                    <input type="text" class="form-control" placeholder="Head's Full Name in En" name="full_name" required value="{{ $head_message->full_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Head's Full Name in Am</label>
                                                    <input type="text" class="form-control" placeholder="Head's Full Name in Am" name="full_name_am" required value="{{ $head_message->full_name_am }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Head's Full Name in Or</label>
                                                    <input type="text" class="form-control" placeholder="Head's Full Name in Or" name="full_name_or" required value="{{ $head_message->full_name_or }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>

                                            <!-- ///////// -->
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Head's Introduction in En</label>
                                                    <input type="text" class="form-control" placeholder="Head's Introduction in En" name="intro" required value="{{ $head_message->intro }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Head's Introduction in Am</label>
                                                    <input type="text" class="form-control" placeholder="Head's Introduction in Am" name="intro_am" required value="{{ $head_message->intro_am }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Head's Introduction in Or</label>
                                                    <input type="text" class="form-control" placeholder="Head's Introduction in Or" name="intro_or" required value="{{ $head_message->intro_or }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <!-- ////////////////////////////////////////////////////////////////// -->
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label>Head's Message in En</label>
                                                    <textarea class="form-control" placeholder="Head's Message in En" name="message" required>{{ $head_message->message }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label>Head's Message in Am</label>
                                                    <textarea class="form-control" placeholder="Head's Message in Am" name="message_am" required>{{ $head_message->message_am }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <label>Head's Message in Or</label>
                                                    <textarea class="form-control" placeholder="Head's Message in Or" name="message_or" required>{{ $head_message->message_or }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>

                                             <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <label>Head's Photo</label>
                                                    <input type="file" class="form-control" id="imgInppp" name="photo" accept="image/jpeg, image/jpg, image/bmp, image/png, image/svg+xml, image/webp">
                                                </div>
                                                <div id="image-preview-container">
                                                    <img src="{{ asset('uploads/Setting/'.$setting->photo) }}" style="max-width: 100px;" alt="your image" />
                                                </div>
                                                <br>
                                            </div>

                                        </div>
                                        <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">SUBMIT</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')

<!-- Jquery Core Js -->
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<!-- <script src="/Smart/Admin/assets/bundles/jvectormap.bundle.js"></script> -->
<script src="/Smart/Admin/assets/bundles/sparkline.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/c3.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/js/pages/index.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah3').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURLpp(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imgInppp').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
    $("#imgInp1").change(function() {
        readURL1(this);
    });
    $("#imgInp2").change(function() {
        readURL2(this);
    });
    $("#imgInp3").change(function() {
        readURL3(this);
    });
    $("#imgInppp").change(function() {
        readURLpp(this);
    });
</script>

<script>
    //redirect to specific tab
    $(document).ready(function() {
        $('#{{$tab}}').tab('show')
    });
</script>
@stop