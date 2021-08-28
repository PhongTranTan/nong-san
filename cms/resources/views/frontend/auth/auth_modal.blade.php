<!--login-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="icon_close"></i>
            </button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-style--popup">
                            <div class="heading-3 text-center">SIGN IN</div>
                            @include('frontend.layouts.partials.alert')
                            <form method="post" action="{{ route('frontend.login.post') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="redirect_to"
                                       value="{{ session()->get('redirect_to') ?? old('redirect_to') }}">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" value="{{ old('email') }}" name="email"
                                           placeholder="Insert email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password"
                                           placeholder="Insert password">
                                </div>
                                <div class="form-group">
                                    <button class="btn-sb">Sign In</button>
                                    <div class="text-center link-forget"><a href="#" data-target="#forgetpModal"
                                                                            data-toggle="modal" data-dismiss="modal">Forgot
                                            Password?</a></div>
                                    <button class="btn-sb btn-sb-outline" data-target="#signUpModal" data-toggle="modal"
                                            data-dismiss="modal">Sign Up
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mSocial">
                            <div class="heading-2"><span>or</span></div>
                            <div class="mSocial__item"><a href="javascript:void(0)" class="naver-login-btn"><i
                                            class="ic-naver"></i><span>Sign in with Naver</span></a></div>
                            <div class="mSocial__item"><a href="javascript:loginWithKakao()"><i
                                            class="ic-talk"></i><span>Sign in with Kakao Talk</span></a></div>
                            <div class="mSocial__item"><a href="javascript:loginWithFacebook()"><i
                                            class="ic-fb"></i><span>Sign in with Facebook</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--sign up-->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="icon_close"></i>
            </button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{ route('frontend.registry.post') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-style--popup">
                                <div class="heading-3 text-center">SIGN UP</div>
                                @include('frontend.layouts.partials.alert')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" required name="name" type="text"
                                           value="{{ old('name') }}" placeholder="Insert name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" required name="email" type="email"
                                           value="{{ old('email') }}" placeholder="Insert email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" required type="password" name="password"
                                           placeholder="Insert password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control" required type="password" name="re_password"
                                           placeholder="Insert password">
                                </div>
                                <div class="form-group">
                                    <button class="btn-sb" type="submit">Sign Up</button>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn-sb btn-sb-outline" data-target="#loginModal"
                                            data-toggle="modal" data-dismiss="modal">Back to Sign In
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div class="mSocial">
                            <div class="heading-2"><span>or</span></div>
                            <div class="mSocial__item"><a href="javascript:void(0)" class="naver-login-btn"><i
                                            class="ic-naver"></i><span>Sign in with Naver</span></a></div>
                            <div class="mSocial__item"><a href="javascript:loginWithKakao()"><i
                                            class="ic-talk"></i><span>Sign in with Kakao Talk</span></a></div>
                            <div class="mSocial__item"><a href="javascript:loginWithFacebook()"><i
                                            class="ic-fb"></i><span>Sign in with Facebook</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--forget-->
<div class="modal fade smallModal" id="forgetpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="icon_close"></i>
            </button>
            <div class="modal-body">
                <div class="form-style--popup">
                    <div class="heading-3 text-center">FORGOT PASSWORD</div>
                    <div class="form-group">
                        <p class="text-center"><strong>Please enter the email address you used to sign up</strong></p>
                        <input class="form-control" type="text" placeholder="Insert email">
                    </div>
                    <div class="form-group">
                        <button class="btn-sb">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--jounus popup-->
<div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="icon_close"></i>
            </button>
            <div class="modal-body">
                <div class="form-style">
                    <div class="heading-3 text-center">PLEASE FILL YOUR INFORMATION <br/>TO ENABLE THIS ACTION</div>
                    <div class="heading-3">PERSON IN CHARGE</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="Insert name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" type="text" placeholder="Insert number">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" placeholder="Insert email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea class="form-control" type="text" placeholder="Insert bio"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="heading-3">COMPANY</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="Insert name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" placeholder="Insert dddress">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" type="text" placeholder="Insert number">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" placeholder="Insert email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea class="form-control" type="text" placeholder="Insert bio"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-auto">
                            <div class="form-group">
                                <button class="btn-sb">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--jounus popup-->
<div class="modal fade" id="comingSoon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="icon_close"></i>
            </button>
            <div class="modal-body">
                <div class="form-style">
                    COMING SOON
                </div>
            </div>
        </div>
    </div>
</div>


<div id="naverIdLogin" style="display: none"></div>
<script src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js"></script>
<script>
    const DOMAIN = '{{ url('') }}';
</script>
<script>
    var naverLogin = new naver.LoginWithNaverId(
        {
            clientId: "{{ env('NAVER_CLIENT_ID', 'g79bnVXHsBqqqCOqGjTr') }}",
            callbackUrl: DOMAIN + "/login/callback/naver",
            isPopup: true,
            loginButton: {color: "green", type: 3, height: 10}
        }
    );
    naverLogin.init();
    $(".naver-login-btn").attr("href", naverLogin.generateAuthorizeUrl());
</script>

<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type='text/javascript'>
    Kakao.init('{{ env('KAKAO_CLIENT_ID','4952af2ee6a114960f1add6f9361b223') }}');
    function loginWithKakao() {
        Kakao.Auth.login({
            success: function (authObj) {
                window.location.href = DOMAIN+ "/login/callback/kakao?access_token=" + authObj.access_token;
            },
            fail: function (err) {
                alert('Error login');
            }
        });
    };
</script>

<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.fbAsyncInit = function () {
        FB.init({
            appId: '{{ env('FACEBOOK_APP_ID','812908832418827') }}',
            cookie: true,  // enable cookies to allow the server to access
            xfbml: true,  // parse social plugins on this page
            version: 'v3.2' // The Graph API version to use for the call
        });
    };

    function loginWithFacebook() {
        FB.login(function (response) {
            console.log(response);
            if (response.status === 'connected') {
                window.location.href = DOMAIN + "/login/callback/facebook?access_token=" + response.authResponse.accessToken;
            } else {
                alert('Error login');
            }
        });
    }
</script>