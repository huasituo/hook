<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
<div class="hstui-frame" style="width: 100%; margin-bottom: 10px">
    <div class="hstui-frame-title">{{ hst_lang('hstcms::manage.e.info') }}</div>
    <div class="hstui-frame-content">
        <table class="hstui-table">
            <thead>
                <tr>
                    <td width="10%">{{ hst_lang('hook::public.hook.name')}}</td>
                <td>{!! $info['name'] !!}</td>
                </tr>
                <tr>
                    <td>{!! hst_lang('hstcms::manage.module') !!}</td>
                    <td>{!! $info['module'] !!}</td>
                </tr>
                <tr>
                    <td>{!! hst_lang('hstcms::manage.add', 'hstcms::manage.time') !!}</td>
                    <td>{!! hst_time2str($info['times'], 'Y-m-d H:i:s') !!}</td>
                </tr>
                <tr>
                    <td>{!! hst_lang('hstcms::manage.description') !!}</td>
                    <td>{!! $info['description'] !!}</td>
                </tr>
                <tr>
                    <td>{!! hst_lang('hook::public.document') !!}</td>
                    <td>{!! $info['document'] !!}</td>
                </tr>
            </thead>
        </table>

    </div>
</div>
<div class="table-main">
    <table class="hstui-table hstui-table-compact hstui-text-nowrap">
       <thead class="hstui-table-head">
            <tr>
                <th width="20%" >{{ hst_lang('hook::public.alias') }}</th>
                <th >{{ hst_lang('hook::public.description') }}</th>
                <th >{{ hst_lang('hook::public.files') }}</th>
                <th >{{ hst_lang('hook::public.class') }}</th>
                <th >{{ hst_lang('hook::public.fun') }}</th>
                <th >{{ hst_lang('hstcms::manage.time') }}</th>
                <th width="10%" >{{ hst_lang('hstcms::manage.operation') }}</th>
            </tr>
        </thead>
        <tbody>
            @if($list)
            @foreach($list as $v)
            <tr>
                <td>{!! $v['alias'] !!}</td>
                <td>{!! $v['description'] !!}</td>
                <td>{!! $v['files'] !!}</td>
                <td>{!! $v['class'] !!}</td>
                <td>{!! $v['fun'] !!}</td>
                <td>{!! hst_time2str($v['times']) !!}</td>
                <td>
                    @if($v['issystem'] == 0)
                    <a class="btn btn-xs btn-info J_dialog" title="{{ hst_lang('hstcms::manage.update')}}{{ hst_lang('hstcms::manage.data')}}" href="{!! route('manageHookInjectEdit', ['name'=>$v['hook_name'], 'id'=>$v['id']]) !!}">{{ hst_lang('hstcms::manage.update')}}</a>
                    <a class="btn btn-xs btn-info J_ajax_del" href="{!! route('manageHookInjectDelete', ['name'=>$v['hook_name'], 'id'=>$v['id']]) !!}">{{ hst_lang('hstcms::manage.delete')}}</a>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5">{!! hst_lang('hstcms::manage.no.list') !!}</td>
            </tr>
            @endif
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