<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 420px; height: 410px">
<form method="post" class="J_ajaxForm" action="{{ route('manageHookAddSave') }}">
    {{ hst_csrf() }}
        <div class="hstui-pop-cont hstui-pop-table">
            <div class="hstui-form hstui-form-horizontal">
                <div class="hstui-form-group" id="J_form_error_name">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.hook.name') }}</label>
                    <input type="text" name="name" id="hstcms_name" class="hstui-form-field hstui-length-4" value="{{ hst_value('name') }}" placeholder="">
                </div>
                <div class="hstui-form-group" id="J_form_error_description">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.description') }}</label>
                    <textarea name="description" id="hstcms_description" class="hstui-length-4" placeholder="" style="height: 120px">{{ hst_value('description') }}</textarea>
                </div>
                <div class="hstui-form-group" id="J_form_error_document">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.document') }}</label>
                    <textarea name="document" id="hstcms_document" class="hstui-length-4" placeholder="" style="height: 120px">{{ hst_value('document') }}</textarea>
                </div>
            </div>
        </div>
            <div class="hstui-pop-bottom">
                <button class="hstui-button " id="J_dialog_close">{{ hst_lang('hstcms::manage.cancel')}}</button>
                <button type="submit" class="hstui-button hstui-button-primary J_ajax_submit_btn" data-dialog="1">{{ hst_lang('hstcms::manage.submit')}}</button>
            </div>
</form>
<script>
  Hstui.use('jquery','common',function() {
    Hstui.css('dialog');
  });
</script>
</body>
</html>