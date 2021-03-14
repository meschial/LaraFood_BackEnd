<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionsProfileController extends Controller
{
    protected $permission;
    protected $profile;
    
    /**
     * __construct
     *
     * @param  mixed $profile
     * @param  mixed $permission
     * @return void
     */
    public function __construct(Profile $profile, Permission $permission)
    {
        $this->permission = $permission;
        $this->profile = $profile;
    }
        
    /**
     * permissions
     *
     * @param  mixed $idProfile
     * @return void
     */
    public function permissions($idProfile)
    {   
        $profile = $this->profile->find($idProfile);

        if(!$profile){
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }

    public function profiles($idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if(!$permission){
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact('profiles', 'permission'));
    }
    
    /**
     * permissionsAvailable
     *
     * @param  mixed $idProfile
     * @return void
     */
    public function permissionsAvailable(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }
    
    /**
     * attachPermissionsProfile
     *
     * @param  mixed $request
     * @param  mixed $idProfile
     * @return void
     */
    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) == 0){
            return redirect()
                    ->back()
                    ->with('warning', 'Precisa escolher uma permissão!');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }
    
    /**
     * detachPermissionProfile
     *
     * @param  mixed $idProfile
     * @param  mixed $idPermission
     * @return void
     */
    public function detachPermissionsProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$permission || !$profile){
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);
        
        return redirect()->route('profiles.permissions', $profile->id);
    }
}

