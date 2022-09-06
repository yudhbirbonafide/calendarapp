<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brands;
use App\Models\BulletType;
use App\Models\Caliber;
use App\Models\Casing;
use App\Models\Retailer;
use App\Models\Rounds;
use App\Models\Bulletweight;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Manufacturer;
use Session;
use File;
 
class AmmunitionController extends Controller{
    
    public function brands(Request $request){
        $result=Brands::paginate(10);
        $heading="Brands";
        return view('admin.ammunition.brands.list',['result'=>$result,'heading'=>$heading]);
    }
    public function brand_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            if(!empty($request->id)){
                Brands::where('id', $request->id)->update(['value'=>$request->value]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Brands::create(['value'=>$request->value]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_brands')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $result="";
        $heading="Brand";
        if(!empty($id)){
            $result = Brands::find($id);
        }
        return view('admin.ammunition.brands.edit',['result'=>$result,'heading'=>$heading]);
    }
    public function brand_delete(Request $request,$id=null){ 
        Brands::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_brands')->with('success','Record has been deleted successfully.');
    }
    public function bullettype(Request $request){
        $result=BulletType::paginate(10);
        $heading="Bullet Type";
        return view('admin.ammunition.bullettype.list',['result'=>$result,'heading'=>$heading]);
    }
    public function bullettype_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            if(!empty($request->id)){
                BulletType::where('id', $request->id)->update(['value'=>$request->value]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= BulletType::create(['value'=>$request->value]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_bullettype')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $result="";
        $heading="Bullet Type";
        if(!empty($id)){
            $result = BulletType::find($id);
        }
        return view('admin.ammunition.bullettype.edit',['result'=>$result,'heading'=>$heading]);
    }
    public function bullettype_delete(Request $request,$id=null){ 
        BulletType::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_bullettype')->with('success','Record has been deleted successfully.');
    }
    public function caliber(Request $request){
        $result=Caliber::paginate(10);
        $heading="Caliber";
        return view('admin.ammunition.caliber.list',['result'=>$result,'heading'=>$heading]);
    }
    public function caliber_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            if(!empty($request->id)){
                Caliber::where('id', $request->id)->update(['value'=>$request->value]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Caliber::create(['value'=>$request->value]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_caliber')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $result="";
        $heading="Caliber";
        if(!empty($id)){
            $result = Caliber::find($id);
        }
        return view('admin.ammunition.caliber.edit',['result'=>$result,'heading'=>$heading]);
    }
    public function caliber_delete(Request $request,$id=null){ 
        Caliber::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_caliber')->with('success','Record has been deleted successfully.');
    }
    public function casing(Request $request){
        $result=Casing::paginate(10);
        $heading="Casing";
        return view('admin.ammunition.casing.list',['result'=>$result,'heading'=>$heading]);
    }
    public function casing_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            if(!empty($request->id)){
                Casing::where('id', $request->id)->update(['value'=>$request->value]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Casing::create(['value'=>$request->value]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_casing')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $result="";
        $heading="Casing";
        if(!empty($id)){
            $result = Casing::find($id);
        }
        return view('admin.ammunition.casing.edit',['result'=>$result,'heading'=>$heading]);
    }
    public function casing_delete(Request $request,$id=null){ 
        Casing::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_casing')->with('success','Record has been deleted successfully.');
    }
    public function retailer(Request $request){
        $result=Retailer::paginate(10);
        $heading="Retailer";
        return view('admin.ammunition.retailer.list',['result'=>$result,'heading'=>$heading]);
    }
    public function retailer_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            $retailer_img="";
            if ($request->hasFile('cat_img')) {
                $retailer_img=$this->fileUpload($request,'retailers');
            }else{
                $retailer_img= $request->old_retailer_img;
            }
            if(!empty($request->id)){
                Retailer::where('id', $request->id)->update(['value'=>$request->value,'retailer_img'=>$retailer_img,'website_url'=>$request->website_url]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Retailer::create(['value'=>$request->value,'retailer_img'=>$retailer_img,'website_url'=>$request->website_url]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_retailer')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $result="";
        $heading="Retailer";
        if(!empty($id)){
            $result = Retailer::find($id);
        }
        return view('admin.ammunition.retailer.edit',['result'=>$result,'heading'=>$heading]);
    }
    public function retailer_delete(Request $request,$id=null){ 
        Retailer::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_retailer')->with('success','Record has been deleted successfully.');
    }
    public function rounds(Request $request){
        $result=Rounds::paginate(10);
        $heading="Rounds";
        return view('admin.ammunition.rounds.list',['result'=>$result,'heading'=>$heading]);
    }
    public function rounds_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            if(!empty($request->id)){
                Rounds::where('id', $request->id)->update(['value'=>$request->value]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Rounds::create(['value'=>$request->value]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_rounds')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $result="";
        $heading="Rounds";
        if(!empty($id)){
            $result = Rounds::find($id);
        }
        return view('admin.ammunition.rounds.edit',['result'=>$result,'heading'=>$heading]);
    }

    public function rounds_delete(Request $request,$id=null){ 
        Rounds::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_rounds')->with('success','Record has been deleted successfully.');
    }
    public function bulletweight(Request $request){
        $result=Bulletweight::paginate(10);
        $heading="Bullet Weight";
        return view('admin.ammunition.bulletweight.list',['result'=>$result,'heading'=>$heading]);
    }
    public function bulletweight_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            if(!empty($request->id)){
                Bulletweight::where('id', $request->id)->update(['value'=>$request->value]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Bulletweight::create(['value'=>$request->value]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_bulletweight')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $result="";
        $heading="Bullet Weight";
        if(!empty($id)){
            $result = Bulletweight::find($id);
        }
        return view('admin.ammunition.bulletweight.edit',['result'=>$result,'heading'=>$heading]);
    }

    public function bulletweight_delete(Request $request,$id=null){ 
        Bulletweight::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_bulletweight')->with('success','Record has been deleted successfully.');
    }

    public function category(Request $request){
        $result=Category::paginate(10);
        $heading="Category";
        return view('admin.ammunition.category.list',['result'=>$result,'heading'=>$heading]);
    }
    public function category_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            $cat_img="";
            if ($request->hasFile('cat_img')) {
                $cat_img=$this->fileUpload($request);
            }else{
                $cat_img= $request->old_cat_img;
            }            
            $subcat=implode(',',$request->subcat);
            if(!empty($request->id)){
                
                Category::where('id', $request->id)->update(['name'=>$request->name,'subcat'=>$subcat,'cat_img'=>$cat_img]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Category::create(['name'=>$request->name,'subcat'=>$subcat,'cat_img'=>$cat_img]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_category')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Unable to insert record.');
            }
        }
        $result="";
        $heading="Category";
        if(!empty($id)){
            $result = Category::find($id);
        }
        $subcategory    = SubCategory::all()->toArray();
        return view('admin.ammunition.category.edit',['result'=>$result,'heading'=>$heading,'subcategory'=>$subcategory]);
    }

    public function category_delete(Request $request,$id=null){ 
        Category::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_category')->with('success','Record has been deleted successfully.');
    }
    public function subcategory(Request $request){
        $result=SubCategory::paginate(10);
        $heading="Sub-Category";
        return view('admin.ammunition.subcategory.list',['result'=>$result,'heading'=>$heading]);
    }
    public function subcategory_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            $subcat_img="";
            if ($request->hasFile('cat_img')) {
                $subcat_img=$this->fileUpload($request,'subcategory');
            }else{
                $subcat_img= $request->old_subcat_img;
            }
            if(!empty($request->id)){
                
                SubCategory::where('id', $request->id)->update(['name'=>$request->value,'subcat_img'=>$subcat_img]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= SubCategory::create(['name'=>$request->value,'subcat_img'=>$subcat_img]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_subcategory')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Unable to insert record.');
            }
        }
        $result="";
        $heading="Sub-Category";
        if(!empty($id)){
            $result = SubCategory::find($id);
        }
        return view('admin.ammunition.subcategory.edit',['result'=>$result,'heading'=>$heading]);
    }

    public function subcategory_delete(Request $request,$id=null){ 
        SubCategory::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_subcategory')->with('success','Record has been deleted successfully.');
    }

    public function manufacturer(Request $request){
        $result=Manufacturer::paginate(10);
        $heading="Manufacturer";
        return view('admin.ammunition.manufacturer.list',['result'=>$result,'heading'=>$heading]);
    }
    public function manufacturer_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            $subcat_img="";
            if ($request->hasFile('cat_img')) {
                $subcat_img=$this->fileUpload($request,'manufacturer');
            }else{
                $subcat_img= $request->old_subcat_img;
            }
            if(!empty($request->id)){
                
                Manufacturer::where('id', $request->id)->update(['value'=>$request->value]);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Manufacturer::create(['value'=>$request->value]);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_ammunition_manufacturer')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Unable to insert record.');
            }
        }
        $result="";
        $heading="Manufacturer";
        if(!empty($id)){
            $result = Manufacturer::find($id);
        }
        return view('admin.ammunition.manufacturer.edit',['result'=>$result,'heading'=>$heading]);
    }

    public function manufacturer_delete(Request $request,$id=null){ 
        Manufacturer::where('id', $id)->delete();
        return redirect()->route('admin_ammunition_manufacturer')->with('success','Record has been deleted successfully.');
    }

    public function fileUpload(Request $request,$folder="category") {
        $this->validate($request, [
            'cat_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);    
        if ($request->hasFile('cat_img')) {
            $image = $request->file('cat_img');
            $name = time().'.'.$image->getClientOriginalExtension();   
            $storage_path='uploads/'.$folder.'/';         
            $destinationPath = public_path().'/'.$storage_path;
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            $image->move($destinationPath, $name);
            return $storage_path.$name;
        }
    }
    
}