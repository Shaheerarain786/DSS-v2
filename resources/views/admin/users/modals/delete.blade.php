@foreach($get_all_users as $user)
    <div class="modal fade" id="{{$user->id}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center bg-primary">
                    <h5 class="heading text-sm-center text-light">Enter Your Password to delete the user</h5>
                </div>

                <!--Body-->
                <div class="modal-body">

                    <form method="POST" action="{{url('users/' . $user->id)}}">
                        @csrf
                        {{method_field('delete')}}

                        <div class="form-group">
                            <div class="col-sm-12">
                                <input id="demo-hor-inputemail" type="password" name="password"
                                       placeholder="Your Password"
                                       class="form-control" value="">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-danger pull-right" type="submit"><i class="fa fa-trash"></i>Delete
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer flex-center">
                    <a type="button" class="btn" data-dismiss="modal">No</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
