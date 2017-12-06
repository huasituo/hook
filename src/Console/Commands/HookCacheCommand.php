<?php 

namespace Huasituo\Hook\Console\Commands;

use Huasituo\Hook\Model\HookModel;
use Huasituo\Hook\Model\HookInjectModel;

use Illuminate\Console\Command;

class HookCacheCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'hook:cache';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hook Cache';

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
        $data = HookModel::setCache();
        $injectAll = HookInjectModel::setAllCache();
        $inject = HookInjectModel::setCache();
        $this->info('hook cache ok!');
    }
}
