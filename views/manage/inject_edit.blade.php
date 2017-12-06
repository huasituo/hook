<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 420px; height: 510px">
<form method="post" class="J_ajaxForm" action="{{ route('manageHookInjectEditSave', ['name'=>$hook_name]) }}">
<input type="hidden" name="id" value="{!! $id !!}">
<input type="hidden" name="alias" value="{{ hst_value('alias', $info) }}">
    {{ hst_csrf() }}
        <div class="hstui-pop-cont hstui-pop-table">
            <div class="hstui-form hstui-form-horizontal">
                <div class="hstui-form-group" id="J_form_error_hook_name">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.hook.name') }}</label>
                    <input type="text" class="hstui-form-field hstui-length-4" value="{{ $hook_name }}" readonly placeholder="">
                </div>
                <div class="hstui-form-group" id="J_form_error_alias">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.alias') }}</label>
                    <input type="text" readonly class="hstui-form-field hstui-length-4" value="{{ hst_value('alias', $info) }}" placeholder="">
                </div>
                <div class="hstui-form-group" id="J_form_error_files">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.files') }}</label>
                    <input type="text" name="files" id="hstcms_files" class="hstui-form-field hstui-length-4" value="{{ hst_value('files', $info) }}" placeholder="">
                </div>
                <div class="hstui-form-group" id="J_form_error_class">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.class') }}</label>
                    <input type="text" name="class" id="hstcms_class" class="hstui-form-field hstui-length-4" value="{{ hst_value('class', $info) }}" placeholder="">
                </div>
                <div class="hstui-form-group" id="J_form_error_fun">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.fun') }}</label>
                    <input type="text" name="fun" id="hstcms_fun" class="hstui-form-field hstui-length-4" value="{{ hst_value('fun', $info) }}" placeholder="">
                </div>
                <div class="hstui-form-group" id="J_form_error_description">
                    <label for="doc-ipt-pwd-21" class="hstui-u-sm-4 hstui-form-label">{{ hst_lang('hook::public.description') }}</label>
                    <textarea name="description" id="hstcms_description" class="hstui-length-4" placeholder="" style="height: 120px">{{ hst_value('description', $info) }}</textarea>
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