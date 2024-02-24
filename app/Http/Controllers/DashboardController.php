<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Classes\Utility;
use App\Models\Orders;
use App\Models\GlobalSettings;
use DB,Auth,File;
use App\Models\Packages;

class DashboardController extends Controller {
    private $type     =  "";
    private $singular =  "Dashboard";
    private $plural   =  "Dashboard";
    private $view     =  "dashboard";
    private $action   =  "/dashboard";
    private $user = [];
    private $perpage = 20;

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index() {
        
        $data   = array(
                    "page_title"=>$this->plural,
                    "page_heading"=>$this->plural,
                    "breadcrumbs"=>array("#"=>$this->plural),
                    "module" => ['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>$this->action]
                );
        
        return view($this->view ,$data);
    }
    public function globalSetting(){
        $data = array(
                    'page_title'   => "Global Settings",
                    'page_heading' => "Global Settings",
                    'breadcrumbs'  => array('#'=>'Global Settings'),
                    'action'       => url('dashboard/update'),
                );
        $data['info'] = GlobalSettings::first();
        return view('global-settings',$data);
    }
    public function updateSettings(Request $request,$id=null){
        
        $data = $request->all();
        // echo "<pre>"; print_r($data);die();
        $path     = base_path().'/files';
        Utility::cleanData($data);
        $site = GlobalSettings::find($id);
        if($request->hasfile('logo')){
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $file->move($path,$fileName);
            $data['image'] = $fileName;
            unset($data['logo']);
            $old = $path.'/'.$site->image;
            if(File::exists($old)) File::delete($old);
        }
        $siteArray = [
            'slogen'           => $data['slogen'],
            'title'            => $data['title'],
            'opening_time'     => $data['opening_time'],
            'skype'            => $data['skype'],
            'off_con'          => $data['off_con'],
            'off_emails'       => $data['off_emails'],
            'site_url'         => $data['site_url'],
            'meta_description' => $data['meta_description'],
            'facebook'         => $data['social']['facebook'],
            'youtube'          => $data['social']['youtube'],
            'dribbble'         => $data['social']['dribbble'],
            'pinterest'        => $data['social']['pinterest'],
            'linkedin'         => $data['social']['linkedin'],
            'twiter'           => $data['social']['twiter'],
            'behance'          => $data['social']['behance'],
        ];
        Utility::appendRole($siteArray);
        // echo '<pre>';print_r($siteArray);die();
        GlobalSettings::where('id',$id)->update($siteArray);
        return back()->with(['msg'=>'Settings updated successfully','location'=>'reload']);
    }
    public function databaseBackup(){
        $host = env('DB_HOST');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $db   = env('DB_DATABASE');
        Utility::exportDatabase($host,$user,$pass,$db);
        return back();
    }
}
