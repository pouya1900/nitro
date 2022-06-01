{{--trash modal--}}
@if(isset($trash))
    <div id="table-deleteModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  b#ff6c60">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">انتقال به سطل زباله-</h4>
                </div>
                <div class="modal-body">اطلاعات به سطل زباله منتقل شوند؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a href="#"
                       @if(isset($table_trash)) onclick="trash( '{{$table_trash['model_type']}}', '{{$table_trash['id']}}')"
                       @endif class="btn b#ff6c60">تایید</a>
                </div>
            </div>
        </div>
    </div>
@endif

{{--unpublish modal--}}
@if(isset($unpublish))
    <div id="yellowModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header b#f1c500">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">عدم انتشار</h4>
                </div>
                <div class="modal-body">رکورد از حالت انتشار خارج شود؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a href="#"
                       @if(isset($table_unpublish)) onclick="publish('{{$table_unpublish['model_type']}}', '{{$table_unpublish['id']}}')"
                       @endif class="btn b#f1c500">تایید</a>
                </div>
            </div>
        </div>
    </div>
@endif

{{--permanently delete modal--}}
@if(isset($delete))
    <div id="table-deleteModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  b#ff6c60">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">حذف</h4>
                </div>
                <div class="modal-body">اطلاعات به کلی حذف شوند؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a href="{{route($delete['route'],$delete['id'])}}" class="btn b#ff6c60">تایید</a>
                </div>
            </div>
        </div>
    </div>
@endif

{{--cancel modal--}}
@if(isset($cancel))
    <div id="yellowModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header b#f1c500">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">انصراف</h4>
                </div>
                <div class="modal-body">تغییرات حذف شوند؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a @if(isset($cancel)) href="{{route($cancel['route'])}}" @endif class="btn b#f1c500">تایید</a>
                </div>
            </div>
        </div>
    </div>
@endif

{{--register modal--}}
@if(isset($register))
    <div id="greenModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header b#78CD51">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ذخیره تغییرات</h4>
                </div>
                <div class="modal-body">تغییرات ذخیره شوند؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <button type="submit" class="btn b#78CD51">ذخیره ی تغییرات</button>
                </div>
            </div>
        </div>
    </div>
@endif
