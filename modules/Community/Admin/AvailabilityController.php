<?php
namespace Modules\Community\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Space\Models\Space;
use Modules\Space\Models\SpaceDate;

class AvailabilityController extends \Modules\Community\Controllers\AvailabilityController
{
    protected $spaceClass;
    /**
     * @var SpaceDate
     */
    protected $spaceDateClass;
    protected $indexView = 'Community::admin.availability';

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('community.admin.index'));
        $this->middleware('dashboard');
    }

}
