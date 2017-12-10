<?php 

namespace Huasituo\Hook\Console\Commands;

use Huasituo\Hook\Model\HookModel;
use Huasituo\Hook\Model\HookInjectModel;

use Illuminate\Console\Command;
use Cache;

class HookListCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'hook:list {--t=null}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hook All';

    /**
     * Create a new command instance.
     *
     * @param Hstcms $hstcms
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $t = $this->option('t');
        if($t == '1') {
            $Hook = HookModel::getAll();
            $Hooks = [];
            $Hooks = HookModel::getAll(2);
            $headers = ['name', 'description'];
            $this->table($headers, $Hooks);
        } else if($t == '2') {
            if (!Cache::has(md5('hookInject'))) {
                $hookInject = HookInjectModel::setAllCache();
            } else {
                $hookInject = Cache::get(md5('hookInject'));
            }
            $hookInjectAll = [];
            foreach ($hookInject as $key => $value) {
                if($hookInjectAll) {
                    $hookInjectAll = array_merge($hookInjectAll, $value);
                } else {
                    $hookInjectAll = $value;
                }
            }
            $headers = ['hookName', 'files', 'class', 'fun'];
            $this->table($headers, $hookInjectAll);
        } else {
            $defaultHookList = config('hook.default.hookList');
            $hookInject = config('hook.default.hookInject');
            if($defaultHookList) {
                foreach ($defaultHookList as $key => $value) {
                    if(!HookModel::where('name', $key)->count()) {
                        HookModel::addInfo($key, $value['description'], $value['document'], 1, $value['module']);
                    } else {
                        HookModel::editInfo($key, $value['description'], $value['document']);
                    }
                }
            }
            if($hookInject) {
                foreach ($hookInject as $key => $value) {
                    foreach ($value as $k => $v) {
                        $info = HookInjectModel::where('hook_name', $v['hook_name'])->where('alias', 'mod_'.$v['alias'])->first();
                        if(!$info) {
                            HookInjectModel::addInfo($v['hook_name'], $v['alias'], $v['files'], $v['class'], $v['fun'], $v['description'], 1);
                        } else {
                            HookInjectModel::editInfo($info['id'], $v['hook_name'], $v['alias'], $v['files'], $v['class'], $v['fun'], $v['description']);
                        }
                    }
                }
            }
            $this->info('Hook Success');
        }
    }
}
