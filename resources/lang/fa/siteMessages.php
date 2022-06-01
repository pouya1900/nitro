<?php
return [
    'exception' => [
        'methodNotFound' => 'متد' . ":method" . 'یافت نشد.',
    ],
    'auth' => [
        'makeUserTokenFail' => 'بروز خطا در ایجاد کد دسترسی کاربر.',
        'logOutSuccess' => 'منتطر دیدار مجدد شما هستیم!',

        'deviceDuplicated' => 'در حال حاضر کاربر با دستگاه دیگری وارد شده است.',

        'activationCodeSent' => 'کد فعالسازی به شماره موبایل ' . ':mobile' . ' ارسال شد.',
        'activationCodeInvalid' => 'کد فعالسازی نامعتبر می باشد.',
        'roleDuplicated' => 'این کاربر در حال حاضر به عنوان  :role ثبت نام کرده است.',
        'activationCodeFail' => 'بروز خطا در ایجاد کد فعالسازی',
        'activationCodeSendFail' => 'بروز خطا در ارسال کد فعالسازی',
        'activationCodeWaitTimeFail' => 'محدودیت ' . ':time' . ' ثانیه ای برای ارسال کد فعالسازی',

        'otpBlock' => 'درخواست کاربر بلاک شده است. لطفا دقایقی دیگر تلاش کنید'
    ],
    'response' => [
        'success' => 'عملیات با موفقیت انجام شد.',
        'failed' => 'بروز خطا در انجام عملیات',
        'failedStatus' => 'failed',
        'successStatus' => 'success'
    ]
];
