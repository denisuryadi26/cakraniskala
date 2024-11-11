<!-- Modal -->
<div class="modal fade" id="myModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="formModal" novalidate>
                    @csrf
                    <input type="hidden" name="id" id="id" class="id" value="{{$profile->id}}">
                    <input type="hidden" name="group_id" value="{{$profile->group_id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group floating-label-form-group">
                                <input type="file" class="files" id="fileUpload" accept="image/png, image/gif, image/jpeg">
                            </fieldset>
                        </div>

                        <div class="col-md-6">
                            <fieldset class="form-group floating-label-form-group">
                                <label for="user-name">Username</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" data-validation-required-message="This field is required" readonly value="{{$profile->username}}">
                                </div>
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="nik">Nik</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Nik" data-validation-required-message="This field is required" value="{{$profile->nik}}">
                                </div>
                            </fieldset>

                            {{-- <fieldset class="form-group floating-label-form-group">
                                 <label for="user-name">Fullname</label>
                                 <div class="controls">
                                     <input type="text" class="form-control" id="fullname" name="fullname"
                                            placeholder="Fullname"
                                            data-validation-required-message="This field is required" value="{{$profile->fullname}}" required>
                        </div>
                        </fieldset>--}}

                        <fieldset class="form-group floating-label-form-group">
                            <label for="user-name">Nama Lengkap</label>
                            <div class="controls">
                                <input type="fullname" class="form-control" id="fullname" name="fullname" placeholder="Nama Lengkap" data-validation-required-message="This field is required" value="{{$profile->fullname}}" required>
                            </div>
                        </fieldset>

                        <fieldset class="form-group floating-label-form-group">
                            <label for="user-name">No Hp</label>
                            <div class="controls">
                                <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No Hp" data-validation-required-message="This field is required" value="{{$profile->no_hp}}" required>
                            </div>
                        </fieldset>

                        <fieldset class="form-group floating-label-form-group">
                            <label for="user-name">Tempat Lahir</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" data-validation-required-message="This field is required" value="{{$profile->tempat_lahir}}" required>
                            </div>
                        </fieldset>

                        <fieldset class="form-group floating-label-form-group">
                            <label for="user-name">Tempat Lahir</label>
                            <div class="controls">
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" data-validation-required-message="This field is required" value="{{$profile->tgl_lahir}}" required>
                            </div>
                        </fieldset>

                        <fieldset class="form-group floating-label-form-group">
                            <label for="unlat">Unlat</label>
                            <div class="controls">
                                <select class="select2 form-control form-control-lg" id="unlat" name="unlat_id" style="padding:10px !important;">
                                    <option value="" selected disabled>Pilih Unlat</option>
                                    @foreach($unlat as $item)
                                    <option value="{{ $item->id }}" {{ $profile->unlat_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>


                        <!-- <fieldset class="form-group floating-label-form-group">
                            <label for="user-name">Email</label>
                            <div class="controls">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-validation-required-message="This field is required" value="{{$profile->email}}" required>
                            </div>
                        </fieldset> -->

                        <fieldset class="form-group floating-label-form-group">
                            <label for="user-name">Password</label>
                            <div class="controls">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </fieldset>

                        <fieldset class="form-group floating-label-form-group">
                            <label for="user-name">Confirm Password</label>
                            <div class="controls">
                                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                                <p class="invalid" hidden>Password Not Match</p>


                            </div>
                        </fieldset>
                    </div>
            </div>



            <div class="modal-footer">
                <!-- <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close
                </button> -->
                <button id="btn-submit" type="submit" class="btn btn-outline-info">Save changes</button>
            </div>
            </form>
        </div>

    </div>
</div>
</div>