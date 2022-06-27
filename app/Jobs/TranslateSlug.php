<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Project;
use App\Handlers\SlugHandler;
use Illuminate\Support\Facades\DB;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $project;
    public function __construct(Project $project)
    {
        //
        $this->project =$project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $slug = app(SlugHandler::class)->translate($this->project->title);

        // 为了避免模型监控器死循环调用，我们使用 DB 类直接对数据库进行操作
        DB::table('projects')->where('id', $this->project->id)->update(['slug' => $slug]);
    }
}
