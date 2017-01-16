@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default bd-rad0 box-shadow panel-bg">
                <div style="height: 20px;" class="bgc-red mg0"></div>
                <div class="panel-body pdh45">
                    <div class="mgb20">
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="fs40">Account Settings</span>
                            </div>
                        </div>
                        <div style="height: 2px;" class="bgc-red mg0"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="dp-bl">Name:</label>
                        </div>
                        <div class="col-md-10" id="nameHover">
                            <span class="dp-bl">{{ Auth::user()->name }} <a href="#!" class="fc-red dp0" id="nameBtn">Edit</a></span>
                        </div>
                    </div>

                    <!-- Change Name -->
                    <form action="{{ route('change.name',Auth::user()->id) }}" method="post" id="nameForm" class="dp0">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="box-shadow">
                                        <input type="text" name="name" class="form-control bd-rad0" placeholder="Full Name">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="box-shadow">
                                    <button class="btn-red-o bd-rad0 wd100P">Save</button>
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                    </form>
                    <!-- Change Name -->

                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="dp-bl">Username:</label>
                        </div>
                        <div class="col-md-10" id="usernameHover">
                            <span class="dp-bl">{{ Auth::user()->username }} <a href="#!" class="fc-red dp0" id="usernameBtn">Edit</a></span>
                        </div>
                    </div>

                    <!-- Change Username -->
                    <form action="{{ route('change.username',Auth::user()->id) }}" method="post" id="usernameForm" class="dp0">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <div class="box-shadow">
                                        <input type="text" name="username" class="form-control bd-rad0" placeholder="Username">
                                    </div>
                                    @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="box-shadow">
                                    <button class="btn-red-o bd-rad0 wd100P">Save</button>
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                    </form>
                    <!-- Change Username -->

                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="dp-bl">Email Address:</label>
                        </div>
                        <div class="col-md-10" id="emailHover">
                            <span class="dp-bl">{{ Auth::user()->email }} <a href="#!" class="fc-red dp0" id="emailBtn">Edit</a></span>
                        </div>
                    </div>

                    <!-- Change Email -->
                    <form action="{{ route('change.email',Auth::user()->id) }}" method="post" id="emailForm" class="dp0">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="box-shadow">
                                        <input type="text" name="email" class="form-control bd-rad0" placeholder="Email Address">
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="box-shadow">
                                    <button class="btn-red-o bd-rad0 wd100P">Save</button>
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                    </form>
                    <!-- Change Email -->

                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="dp-bl">Position:</label>
                        </div>
                        <div class="col-md-10">
                            <span class="dp-bl">{{ Auth::user()->position }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="dp-bl">Role:</label>
                        </div>
                        <div class="col-md-10">
                            <span class="dp-bl">{{ ucfirst(Auth::user()->role) }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mgb10">
                        <div class="col-md-2">
                            <label class="dp-bl">Password:</label>
                        </div>
                        <div class="col-md-10">
                            <span class="dp-bl"><a href="#!" class="fc-red" id="passwordBtn">Change Password</a></span>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <form action="{{ route('change.password',Auth::user()->id) }}" method="post" id="passwordForm" class="dp0">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                    <div class="box-shadow">
                                        <input type="password" name="old_password" class="form-control bd-rad0" placeholder="Old Password">
                                    </div>
                                    @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                    <div class="box-shadow">
                                        <input type="password" name="new_password" class="form-control bd-rad0" placeholder="New Password">
                                    </div>
                                    @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                    <div class="box-shadow">
                                        <input type="password" name="confirm_password" class="form-control bd-rad0" placeholder="Confirm Password">
                                    </div>
                                    @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                        <div class="row mgb10">
                            <div class="col-md-3 col-md-offset-2">
                                <div class="box-shadow">
                                    <button class="btn-red-o bd-rad0 wd100P">Save</button>
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                        </div>
                    </form>
                    <hr>
                    <!-- Change Password -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#passwordBtn').on('click', function(){
                $('#passwordForm').slideToggle(300);
            });

            $('#nameHover').on('mouseenter', function(){
                $('#nameBtn').show();
            }).on('mouseleave', function(){
                $('#nameBtn').hide();
            });

            $('#nameBtn').on('click', function(){
                $('#nameForm').slideToggle(300);
            });

            $('#usernameHover').on('mouseenter', function(){
                $('#usernameBtn').show();
            }).on('mouseleave', function(){
                $('#usernameBtn').hide();
            });

            $('#usernameBtn').on('click', function(){
                $('#usernameForm').slideToggle(300);
            });

            $('#emailHover').on('mouseenter', function(){
                $('#emailBtn').show();
            }).on('mouseleave', function(){
                $('#emailBtn').hide();
            });

            $('#emailBtn').on('click', function(){
                $('#emailForm').slideToggle(300);
            });
        });
    </script>
@stop