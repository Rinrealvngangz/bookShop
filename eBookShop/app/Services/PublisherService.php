<?php


namespace App\Services;

use App\Contracts\PublisherContract;
use App\Models\Publisher;
use Symfony\Component\Console\Input\Input;

class PublisherService implements PublisherContract
{
   public function getAll()
   {
       $publisher = Publisher::all();
       return $publisher;
   }

    public function create($request)
    {

        $result = array('error' => 'error', 'success' => 'success');
        $check = Publisher::where('name','=',$request['add-name-publisher'])->first();
        if ($check === null){
            Publisher::create([
                'name' =>$request->input('add-name-publisher'),
            ]);
            return $result['success'];
        }
        else{
            return  $request['error'];
        }




    }
    public function update($Request)
    {
        $result = array('error' => 'error', 'success' => 'success');
        $ids = $Request['idPublisher'];
        $check = Publisher::where('name','=',$Request['edit_name_publisher'])->first();
        $publisher = Publisher::find($ids);
        if ($check === null)
        {
            $publisher->name = $Request->input('edit_name_publisher');
            $publisher->save();
            return $result['success'];
        }
        else{
            return $result['error'];
        }
    }
    public function delete($Request)
    {
        $ids = $Request['idPublisher'];
        $result = array('error' => 'error', 'success' => 'success');
        $publisher = Publisher::find($ids);
        if ($publisher !== null){
            $publisher->delete();
            return $result['success'];
        }
        else{
            return $result['error'];
        }
    }
}
