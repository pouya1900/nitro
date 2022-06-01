<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.css')}}">
        <style>
            body {
                direction: ltr;
                background: #F3EBF6 url({{ asset('assets/dashboard/img/login.jpg') }});
                font-family: Helvetica, Arial, sans-serif;
            }
            .main {
                background-color: #FFFFFF;
                width: 400px;
                margin: 7em auto;
                border-radius: 1.5em;
                box-shadow: 0 11px 35px 2px rgba(0, 0, 0, 0.14);
            }

            .sign {
                padding-top: 30px;
                color: #8C55AA;
                font-family: Helvetica, Arial, sans-serif;
                font-weight: bold;
                font-size: 23px;
            }

            .un {
                width: 76%;
                color: rgb(38, 50, 56);
                font-weight: 700;
                font-size: 14px;
                letter-spacing: 1px;
                background: rgba(136, 126, 126, 0.04);
                padding: 10px 20px;
                border-radius: 20px;
                outline: none;
                box-sizing: border-box;
                border: 2px solid rgba(0, 0, 0, 0.02);
                margin-left: 46px;
                text-align: center;
                margin-bottom: 27px;
                font-family: Helvetica, Arial, sans-serif;
            }

            form.form1 {
                padding-top: 20px;
            }

            .pass {
                width: 76%;
                color: rgb(38, 50, 56);
                font-weight: 700;
                font-size: 14px;
                letter-spacing: 1px;
                background: rgba(136, 126, 126, 0.04);
                padding: 10px 20px;
                border-radius: 20px;
                outline: none;
                box-sizing: border-box;
                border: 2px solid rgba(0, 0, 0, 0.02);
                margin-left: 46px;
                text-align: center;
                margin-bottom: 20px;
                font-family: Helvetica, Arial, sans-serif;
            }

            .remember-me {
                color: rgb(38, 50, 56);
                font-weight: 700;
                font-size: 14px;
                letter-spacing: 1px;
                background: rgba(136, 126, 126, 0.04);
                padding: 10px 20px;
                border-radius: 20px;
                outline: none;
                box-sizing: border-box;
                border: 2px solid rgba(0, 0, 0, 0.02);
                text-align: center;
                margin:0 0 27px 130px !important;
                font-family: Helvetica, Arial, sans-serif;
            }
            .un:focus, .pass:focus, .remember-me:focus  {
                border: 2px solid rgba(0, 0, 0, 0.18) !important;
            }
            .submit {
                cursor: pointer;
                border-radius: 5em;
                color: #fff;
                background: linear-gradient(to right, #9C27B0, #E040FB);
                border: 0;
                padding-left: 40px;
                padding-right: 40px;
                padding-bottom: 10px;
                padding-top: 10px;
                font-family: Helvetica, Arial, sans-serif;
                margin-left: 37%;
                font-size: 13px;
                box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
            }

            .forgot {
                text-shadow: 0 0 3px rgba(117, 117, 117, 0.12);
                color: #E1BEE7;
                padding-top: 15px;
                padding-bottom: 30px;
            }

            label {
                text-shadow: 0 0 3px rgba(117, 117, 117, 0.12);
                color: #E1BEE7;
                padding-top: 15px;
            }

            .forgot a{
                text-decoration: none;
            }

            a {
                text-shadow: 0 0 3px rgba(117, 117, 117, 0.12);
                color: #E1BEE7;
                text-decoration: none
            }

            .alert{
                direction: rtl;
            }

            @media (max-width: 600px) {
                .main {
                    border-radius: 0;
                }
            }
        </style>
        <title>پنل کاربری</title>
    </head>
    <body>
        <div class="main">
            <p class="sign" align="center">ورود به پنل مدیریت</p>
            <form class="form1" action="{{ route('admin.login') }}" method="post">
                {{ csrf_field() }}
                @if (count($errors))
                   <div class="alert alert-danger alert-dismissible" role="alert">
                       <strong>{{ $errors->first() }}</strong>
                   </div>
               @endif
                <input required value="{{ old('mobile') }}" name="mobile" class="un" type="text" align="center" placeholder="موبایل">
                <input required value="{{ old('password') }}" name="password" class="pass" type="password" align="center" placeholder="گذرواژه">
                <input id="remember-me" class="remember-me" name="remember" type="checkbox" align="center">
                <label title="در صورتی که این گزینه را انتخاب کنید، مدت زمان بیشتری در صفحه لاگین خواهید بود." for="remember-me">مرا به یاد داشته باش</label>
                <input type="submit" class="submit" value="ورود" align="center">
            </form>
            <p class="forgot" align="center"><a href="#">{{--فراموشی گذرواژه--}}</a></p>
        </div>
    </body>
</html>