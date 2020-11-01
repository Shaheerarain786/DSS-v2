<form class="form-horizontal" method="POST" action="{{url('device-templates/store')}}" enctype="multipart/form-data">
    @csrf
    <div class="panel-body">
        <div class="form-group">
            @if(isset($video_count) && $video_count > 0)
                @for($i = 1;  $i <= $video_count; $i++)
                    <label class="col-md-2 control-label text-primary text-bold">Videos Box {{$i}}</label>
                    <div class="col-md-4">
                        <input multiple accept="video/*" type="file" class="form-control" name="video_{{$i}}[]">
                    </div>
                @endfor
                <br>
            @endif
        </div>
        <div class="form-group">
            @if(isset($images_count) && $images_count > 0)
                @for($i = 1;  $i <= $images_count; $i++)
                    <label class="col-md-2 control-label text-primary text-bold">Image Box {{$i}}</label>
                    <div class="col-md-4">
                        <input multiple accept="image/*" type="file" class="form-control" name="image_{{$i}}[]">
                    </div>
                @endfor
                <br>
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label text-primary text-bold"
                   for="demo-hor-inputemail">Logo</label>
            <div class="col-sm-10">
                <input type="file" name="logo" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label text-primary text-bold"
                   for="demo-hor-inputemail">Ticker Text</label>
            <div class="col-sm-10">
                <input type="text" name="ticker_text" class="form-control">
            </div>
        </div>
        <input type="hidden" value="{{$template_id}}" name="template_id">
    </div>
    <div class="panel-footer text-right">
        <button class="btn btn-primary" type="submit">Set</button>
    </div>
</form>
