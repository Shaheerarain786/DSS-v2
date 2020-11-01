@foreach($templates as $key => $temp)
    <div class="modal fade" id="images-model-{{$temp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center bg-primary">
                    <h5 class="heading text-sm-center text-light">Template Assign Images</h5>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sr #</th>
                            <th>Images</th>
                            <th>Box #</th>
                        </tr>
                        @foreach($temp->images as $key => $image)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><img src="{{url('/') . '/' . $image->asset_url}}" height="50" alt=""></td>
                                <td>{{$image->asset_box_number}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
@endforeach

