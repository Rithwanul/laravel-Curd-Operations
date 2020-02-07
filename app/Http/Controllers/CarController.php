<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Requests\carsStorePostRequest;
use App\Http\Requests\carsUpdatePutRequest;
use Illuminate\Support\Facades\Storage;
use Image;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car = Car::paginate(5);
        return view('vehicles.index')->with('cars', $car);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(carsStorePostRequest $request)
    {
        $car = new Car();

        $car->name  =  $request->name;
        $car->email =  $request->email;

        /*
            Creating Unique Name For the Image
        */ 

        $imageName = time(). '.' . uniqid() . '.' .$request->image->getClientOriginalName();

        /*
            Resizing and Saving the image Into Storage/Cars Folder 
            Using Intervention/Image Plugin
        */

        $img = Image::make($request->image)->resize(300, 300)->save('storage/cars/' . $imageName);

        $car->image = $imageName;
        $car->save();

        return redirect()->route('cars.index')->with('Success', 'Data Has Been Added Successfully');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        return view('vehicles.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(carsUpdatePutRequest $request, Car $car)
    {
        $vehicles        = Car::find($car->id);
        $vehicles->name  = $request->name;
        $vehicles->email = $request->email;
        
        if($request->hasFile('image')){
            /*
                Creating Unique Name For the Image
            */ 

            $imageName = time(). '.' . uniqid() . '.' .$request->image->getClientOriginalName();

            /*
                Resizing and Saving the image Into Storage/Cars Folder 
                Using Intervention/Image Plugin
            */

            $img = Image::make($request->image)->resize(300, 300)->save('storage/cars/' . $imageName);
            
            $vehicles->image = $imageName;
        }

        $vehicles->save();

        return redirect()->route('cars.index')->with('Success', 'Data Has Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $vehicles = Car::find($car->id);

        $value = Storage::delete('public/cars/' . $car->image);
        $vehicles->delete();

        // dd($car->image);

        return redirect()->route('cars.index')->with('Success', 'Data Has Been Deleted Successfully');
    }
}
