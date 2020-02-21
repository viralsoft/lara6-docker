<?php

namespace ViralsPackage\ViralsInventory\app\Console\Commands;

use Illuminate\Console\Command;

class AddSidebarContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'virals-inventory:add-sidebar-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add HTML/PHP code to the Base sidebar_content file';

    /**
     * Create a new command instance.
     *
     * @return void
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

        $path = __DIR__ . '/../../../resources/views/sidebar-content.blade.php';
        $menu_path = base_path().'/resources/views/layouts/menu.blade.php';
        if (file_exists($path)) {
            $contents = file_get_contents($path);
            file_put_contents($menu_path, $contents, FILE_APPEND);
            $this->info('Successfully added code to sidebar_content file.');
        } else {
            $this->error("The sidebar-content file does not exist. Make sure ViraslPermission is properly installed.");
        }
    }
}
