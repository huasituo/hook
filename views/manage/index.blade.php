<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
<div class="table-main">
    <table class="hstui-table hstui-table-bordered hstui-table-radius hstui-table-striped hstui-table-hover hstui-table-compact hstui-text-nowrap">
       <thead class="hstui-table-head">
            <tr>
                <th width="20%" >{{ hst_lang('hook::public.hook.name') }}</th>
                <th width="20%" >{{ hst_lang('hook::public.module') }}</th>
                <th >{{ hst_lang('hstcms::manage.time') }}</th>
                <th width="10%" >{{ hst_lang('hstcms::manage.operation') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $v)
            <tr>
                <td>{!! $v['name'] !!}</td>
                <td>{!! $v['module'] !!}</td>
                <td>{!! hst_time2str($v['times']) !!}</td>
                <td>
                    <a class="btn btn-xs btn-info" title="" href="{!! route('manageHookInjectIndex', ['name'=>$v['name']]) !!}">{{ hst_lang('hstcms::manage.view')}}</a>
                    @if($v['issystem'] == 0)
                    <a class="btn btn-xs btn-info J_dialog" title="{{ hst_lang('hstcms::manage.update')}}{!! $v['name'] !!}{{ hst_lang('hstcms::manage.data')}}" href="{!! route('manageHookEdit', ['name'=>$v['name']]) !!}">{{ hst_lang('hstcms::manage.update')}}</a>
                    <a class="btn btn-xs btn-info J_ajax_del" href="{!! route('manageHookDelete', ['name'=>$v['name']]) !!}">{{ hst_lang('hstcms::manage.delete')}}</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>