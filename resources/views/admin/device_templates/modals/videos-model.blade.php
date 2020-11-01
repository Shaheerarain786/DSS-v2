@foreach($templates as $key => $temp)
    <div class="modal fade" id="videos-model-{{$temp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center bg-primary">
                    <h5 class="heading text-sm-center text-light">Template Assign Videos</h5>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sr #</th>
                            <th>Videos</th>
                            <th>Box #</th>
                        </tr>
                        @foreach($temp->videos as $key => $videos)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    <a target="_blank" class="btn btn-primary" href="{{url('/') . '/' . $videos->asset_url}}">
                                        <i class="fa fa-video"></i>
                                    </a>
                                </td>
                                <td>{{$videos->asset_box_number}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
@endforeach

