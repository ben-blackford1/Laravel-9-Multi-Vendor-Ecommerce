<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard() {
        return view('admin.index');
    }

    // Admin login
    public function AdminLogin() {
        return view('admin.admin_login');
    }

    // Admin logout
    public function AdminDestroy(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    // Access all admin details
    public function AdminProfile() {
        $id = Auth::user()->id;
        
        $adminData = User::find($id);
        
        return view('admin.admin_profile_view', compact('adminData'));
    }

    // Update all admin details
    public function AdminProfileStore(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        // Handle profile image
        if($request->file('photo')) {
            $file = $request->file('photo');
            // Delete old photo from the folder when a new photo is uploaded
            @unlink(public_path('upload/admin_images/'.$data->photo));
            // Create unique filename
            $filename = date('YmdHi').$file->getClientOriginalName();
            // Move the photo to admin_images under the new file name
            $file->move(public_path('upload/admin_images'), $filename);
            
            $data['photo'] = $filename;
        }
        // Store photo in the DB
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Details Updated Successully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Update admin password
    public function AdminChangePassword() {
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed', 
        ]);

        // Check if the old password inputted is correct
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Does Not Match.");
        }

        // Update the user's password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", "Password Successfully Updated.");

    } 

    // Get inactive vendors
    public function InactiveVendors() {
        $inactiveVendors = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendors', compact('inactiveVendors'));
    }

    // Get active vendors
    public function ActiveVendors() {
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendors', compact('activeVendors'));
    }

    // Inactive vendor details
    public function InactiveVendorDetails($id) {
        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inactiveVendorDetails'));
    }

     // Active vendor details
     public function ActiveVendorDetails($id) {
        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    }

    public function ActiveVendorApprove(Request $request) {
        $vendorId = $request->id;
        $user = User::findOrFail($vendorId)->update([
            'status' => 'active', 
        ]);

        $notification = array(
            'message' => 'Vendor is now set to active.',
            'alert-type' => 'success'
        );

        return redirect()->route('active.vendors')->with($notification);
    }

    public function inactiveVendorApprove(Request $request) {
        $vendorId = $request->id;
        $user = User::findOrFail($vendorId)->update([
            'status' => 'inactive', 
        ]);

        $notification = array(
            'message' => 'Vendor is now set to inactive.',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendors')->with($notification);
    }
}
