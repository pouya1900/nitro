<div class="tab-pane fade p-bottom-30 active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-5 mb-lg-0">
                <div class="user_pro_img_area">
                    <img src="{{ Auth::user()->avatar['tiny'] }}">
                    <div class="image-info">
                        <h6>تصویر پروفایل</h6>
                        <span>JPG or PNG 120x120 px</span>
                    </div>
                    <div class="input-group image-preview m-b-15">
                        <input id="image" name="image" type="file" class="dropify" />
                    </div>
                    @if ($errors->has('image'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>{{$error('image')}}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="atbd_author_module">
                    <div class="atbd_content_module">
                        <div class="atbd_content_module__tittle_area">
                            <div class="atbd_area_title">
                                <h4><span class="la la-user"></span>پروفایل من</h4>
                            </div>
                        </div>
                        <div class="atbdb_content_module_contents">
                            <div class="user_info_wrap">
                                <form method="post" action="{{ route('user.update', $user->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    <div class="row">

                                        @if($errors->any())
                                            <div class=" col-md-12 alert alert-danger alert-dismissible">
                                                <p>لطفا قبل از ادامه ی کار خطاهای زیر را اصلاح کنید:</p>
                                                @foreach($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name" class="not_empty">نام</label>
                                                <input class="form-control" type="text" placeholder="نام"
                                                       value="{{ old('first_name') ?? $user->firstName }}"
                                                       id="first_name"
                                                       name="first_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile" class="not_empty">شماره موبایل</label>
                                                <input class="form-control" id="mobile" type="text" disabled="disabled"
                                                       value="{{ $user->mobile }}">
                                                <p>(شماره موبایل را نمی توان تغییر داد)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name" class="not_empty">نام خانوادگی</label>
                                                <input class="form-control"
                                                       value="{{ old('last_name') ?? $user->last_name }}" id="last_name"
                                                       type="text"
                                                       name="last_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="female" class="not_empty">جنسیت</label>
                                                <select class="form-control" type="text" id="female" name="female">
                                                    <option
                                                        value="0" @if(empty($user->profile->female)) {{ 'selected' }} @endif>
                                                        آقا
                                                    </option>
                                                    <option
                                                        value="1" @if(!empty($user->profile->female)) {{ 'selected' }} @endif>
                                                        خانم
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="facebook" class="not_empty">facebook</label>
                                                <input class="form-control"
                                                       value="{{ old('facebook') ?? $user->profile->facebook }}"
                                                       id="facebook" type="text" name="facebook">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="twitter" class="not_empty">twitter</label>
                                                <input class="form-control"
                                                       value="{{ old('twitter') ?? $user->profile->twitter }}"
                                                       id="twitter" type="text" name="twitter">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="instagram" class="not_empty">instagram</label>
                                                <input class="form-control"
                                                       value="{{ old('instagram') ?? $user->profile->instagram }}"
                                                       id="instagram" type="text" name="instagram">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="linkedin" class="not_empty">linkedin</label>
                                                <input class="form-control"
                                                       value="{{ old('linkedin') ?? $user->profile->linkedin }}"
                                                       id="linkedin" type="text" name="linkedin">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birthday" class="not_empty">تاریخ تولد</label>
                                                <input class="form-control"
                                                       value="{{ old('birthday') ?? $user->profile->birthday }}"
                                                       id="birthday" type="text" name="birthday">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="company" class="not_empty">نام شرکت(فارسی)</label>
                                                <input class="form-control"
                                                       value="{{ old('company') ?? $user->profile->company }}"
                                                       id="company" type="text" name="company">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="en_company" class="not_empty">نام شرکت (لاتین)</label>
                                                <input class="form-control"
                                                       value="{{ old('en_company') ?? $user->profile->en_company }}"
                                                       id="en_company" type="text" name="en_company">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="specialist" class="not_empty">تخصص (فارسی)</label>
                                                <input class="form-control"
                                                       value="{{ old('specialist') ?? $user->profile->specialist }}"
                                                       id="specialist" type="text" name="specialist">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="en_specialist" class="not_empty">تخصص (لاتین)</label>
                                                <input class="form-control"
                                                       value="{{ old('en_specialist') ?? $user->profile->en_specialist }}"
                                                       id="en_specialist" type="text" name="en_specialist">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="about" class="not_empty">بیوگرافی (فارسی)</label>
                                                <textarea class="wp-editor-area form-control" rows="6"
                                                          autocomplete="off" id="about" name="about">{{ old('about') ?? $user->profile->about }}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="en_about" class="not_empty">بیوگرافی (لاتین)</label>
                                                <textarea class="wp-editor-area form-control" rows="6"
                                                          autocomplete="off" id="en_about" name="en_about">{{ old('en_about') ?? $user->profile->en_about }}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div><!--ends social info .row-->
                                    <button type="submit" class="btn btn-primary" id="update_user_profile">ذخیره
                                        تغییرات
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- ends: .atbd_author_module -->
            </div>
        </div>
    </div>
</div><!-- ends: .tab-pane -->
