<div class="modal fade" id="tenmplate1" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center bg-primary">
                <h5 style="color:white !important;" class="heading">Add Zone</h5>
            </div>

            <!--Body-->
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{url('zones')}}">
                    @csrf
                    @method("POST")
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label text-primary text-bold">Videos</label>
                            <div class="col-md-9">
                                <div class="bord-top pad-ver" style="text-align: left">
                                    <span class="btn btn-success btn-sm fileinput-button dz-clickable">
					                <i class="fa fa-plus"></i>
					                <span>Add files...</span>
					            </span>

                                    <div class="btn-group pull-right">
                                        <button id="dz-upload-btn" class="btn btn-primary btn-sm" type="submit" disabled>
                                            <i class="fa fa-upload-cloud"></i> Upload
                                        </button>
                                        <button id="dz-remove-btn" class="btn btn-danger cancel" type="reset" disabled>
                                            <i class="demo-psi-trash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div id="dz-previews">
                                    <div id="dz-template" class="pad-top bord-top">
                                        <div class="media">
                                            <div class="media-body">
                                                <!--This is used as the file preview template-->
                                                <div class="media-block">
                                                    <div class="media-left">
                                                        <img class="dz-img" data-dz-thumbnail>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="text-main text-bold mar-no text-overflow" data-dz-name></p>
                                                        <span class="dz-error text-danger text-sm" data-dz-errormessage></span>
                                                        <p class="text-sm" data-dz-size></p>
                                                        <div id="dz-total-progress" style="opacity:0">
                                                            <div class="progress progress-xs active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-right">
                                                <button data-dz-remove class="btn btn-xs btn-danger dz-cancel"><i class="demo-psi-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label text-primary text-bold"
                                   for="demo-hor-inputemail">Logo</label>
                            <div class="col-sm-9">
                                <input type="file" name="logo" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label text-primary text-bold"
                                   for="demo-hor-inputemail">Video</label>
                            <div class="col-sm-9">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label text-primary text-bold"
                                   for="demo-hor-inputemail">Ticker Text</label>
                            <div class="col-sm-9">
                                <input type="text" name="ticker" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Set</button>
                    </div>
                </form>
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <a type="button" class="btn btn-info" data-dismiss="modal"><i
                        class="fa fa-times"></i></a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
