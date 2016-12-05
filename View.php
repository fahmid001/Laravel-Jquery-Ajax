@extends('controlpanel/mainlayout')

@section('content')
<div class="directions">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>{{ Session::get('success_message') }}</div>
            @elseif (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>{{ Session::get('error_message') }}</div>
            @endif
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Branch</h3>
                </div>
                <form class="form-horizontal" action="{{URL::to('branch-store')}}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="branch_type" class="col-sm-3 control-label">Select Division<span style="color:red">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="division" id="division" onchange="getdistrictList(this.value)" required="required" autocomplete="off">
                                    <option value=''>Select Division</option>
                                    @foreach($divisionList as $division)
                                    <option value="{{$division->id}}">{{$division->div_name}}</option>
                                    @endforeach
                                </select>
                                <span style="color: red"><?php echo $errors->branch->first('division'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="branch_type" class="col-sm-3 control-label">Select District<span style="color:red">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control"  name="district" id="district" onchange="getupazilaList(this.value)" required="required" autocomplete="off">
                                    <option value=''>Select District</option>
                                </select>
                                <span style="color: red"><?php echo $errors->branch->first('district'); ?></span>
                            </div>
                            <div hidden id="showloging" class="col-sm-1"> <img src="{{URL::to('/')}}/upload/picture/loading.gif" class="img-circle" width="30" height="25"></div>
                        </div>
                        <div class="form-group">
                            <label for="branch_type" class="col-sm-3 control-label">Select Upazila<span style="color:red">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control"  name="upazila" id="upazila" required="required" autocomplete="off">
                                    <option value=''>Select Upazila</option>
                                </select>
                                <span style="color: red"><?php echo $errors->branch->first('upazila'); ?></span>
                            </div>
                            <div hidden id="showloging2" class="col-sm-1"> <img src="{{URL::to('/')}}/upload/picture/loading.gif" class="img-circle" width="30" height="25"></div>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</section>

<script type="text/javascript">

    function getdistrictList(id) {
        $('#showloging').show();
        var value = id;
        $.ajax({
            type: "GET",
            url: "{{URL::to('/')}}/getdistrictList",
            data: {value: value},
            success: function (result) {
                //alert(result);
                if (result != '') {
                    $('#district').html(result);
                    $('#showloging').hide();
                } else {
                    $('#district').html('No District Found');
                }

            }
        }, "json");

    }


    function getupazilaList(id) {
        $('#showloging2').show();
        var value = id;
        $.ajax({
            type: "GET",
            url: "{{URL::to('/')}}/getupazilaList",
            data: {value: value},
            success: function (result) {
                //alert(result);
                if (result != '') {
                    $('#upazila').html(result);
                    $('#showloging2').hide();
                } else {
                    $('#upazila').html('No Upazila Found');
                }

            }
        }, "json");

    }
</script>
@stop
