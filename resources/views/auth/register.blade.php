
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contactno') ? ' has-error' : '' }}">
                            <label for="contactno" class="col-md-4 control-label">Contact No.</label>

                            <div class="col-md-6">
                                <input id="contactno" type="text" class="form-control" name="contactno" value="{{ old('contactno') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                            <input type="radio" id="male" name="gender" value="0" checked>
                            <label for="male">Male</label><br>
                            <input type="radio" id="female" name="gender" value="1">
                            <label for="female">Female</label><br>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }}">
                            <label for="designation" class="col-md-4 control-label">Designation</label>

                            <div class="col-md-6">
                                    <select name="designation" id="designation">
                                    @foreach($Designations as $Designation)
                                       <option value="{{$Designation->id}}">{{$Designation->Description}}</option>
                                    @endforeach
                                    </select>
                                <!-- 
                                <input id="designation" type="text" class="form-control" name="designation" value="{{ old('designation_id') }}" required autofocus> -->

                                @if ($errors->has('designation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('designation_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="IsDoctor" class="col-md-4 control-label">Doctor</label>

                            <div class="col-md-6">
                                <input id="IsDoctor" type="checkbox" class="form-control" name="IsDoctor">
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="IsNurse" class="col-md-4 control-label">Nurse</label>

                            <div class="col-md-6">
                                <input id="IsNurse" type="checkbox" class="form-control" name="IsNurse">
                            </div>
                        </div> -->

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="IsAdmin" class="col-md-4 control-label">Super User</label>

                            <div class="col-md-6">
                                <input id="IsAdmin" type="checkbox" class="form-control" name="IsAdmin">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
