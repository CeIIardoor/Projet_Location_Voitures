<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Car;
use App\Models\Mark;

use Image;
use Auth;
use Carbon\Carbon;

class CarController extends Controller
{

	public function  showCarsByMark($id)
	{
  	    $cars=Car::where('mark_id','=',$id)->get();
		return(view('pages.cars.viewByMark',['cars'=>$cars]));

    }


	public function showCarsList()
	{
       $cars=Car::all();
       $marks=Mark::all();
 
	   return view('pages.cars.list',['cars'=>$cars,'marks'=>$marks]);
   }  

	

	public function showAddCar()
   { 
   	$marks=Mark::all();
   	return view('pages.cars.add',['marks'=>$marks]);
   }



   public function handleAddCar()
   {
	$data=Request::all();

	

		$photo = 'photo-' . time() . '.' . $data['photo']->getClientOriginalExtension();
        $photoPath = 'storage/car/' . $photo;
		$fullImagePath = public_path($photoPath);
		
        Image::make($data['photo']->getRealPath())->resize(540,320)->save($fullImagePath);
	    

	Car::create([
		'model'	      =>    $data['model'],
		'people'      =>	$data['people'],
		'doors'       =>	$data['doors'],
		'mileage' 	  =>	$data['mileage'],
		'price'   	  =>	$data['price'],
		'transmission'=>	$data['transmission'],
		'photo'       =>    $photoPath,
		'mark_id'     =>	$data['mark']
	]);

	return redirect(route('showCarsList'))->with('status', 'Car added');	
	}



	public function showDeleteCar()
   { 
   	$cars=Car::all();

   	return view('pages.admin.delete',['cars'=>$cars]);
   }


   public function handleDeleteCar($id)
   {
   	   $car=Car::find($id);

   		if($car){
   			$car->delete();

   			return redirect()->back()->with('success', 'Car deleted');
   }
   }



	public function showAddMark()
   { 
   	return view('pages.cars.addMark');
   }



   public function handleAddMark()
   {
	$data=Request::all();
	
	Mark::create([
		'name'	=>	$data['name']
		]);

	return redirect(route('showCarsList'))->with('success', 'Brand added');
	
	}
	
	
}
