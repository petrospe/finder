<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity;
use App\Attribute;
use App\Status;
use App\Http\Resources\EntityResource;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EntityResource::collection(Entity::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $entity = Entity::create([
        'attribute_id' => $request->attribute_id,
        'parent_id' => $request->parent_id,
        'display_order' => $request->display_order,
        'row_value' => $request->row_value,
        'status_id' => $request->status_id,
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $entity = Entity::findOrFail($id);
      return new EntityResource($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $entity = Entity::findOrFail($id);
      $entity->update($request->all());

      return new EntityResource($entity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Entity::destroy($id);
      return response()->json(null, 204);
    }

    public function getEntityAttribute($attributeName, $statusName, $page=1, $per_page=10)
    {
      $categoryAttribute = Attribute::where('name',$attributeName)->first();
      $status = Status::where('name',$statusName)->first();
      $categoryEntities = array();
      $categoryInstances = array();
      $categoryInstancesArr = array();
      $categories = array();
      if($categoryAttribute){
        $categoryEntities = Entity::where('attribute_id',$categoryAttribute->id)->where('status_id',$status->id)->whereNull('parent_id')->get();
        foreach ($categoryEntities as $categoryEntity) {
          $categories = Entity::where('parent_id',$categoryEntity->id)->get();
          $attributeName = array();
          $attributeRawValue = array();
          foreach ($categories as $category) {
              if(!empty($category->row_value)){
                $attribute = Attribute::findOrFail($category->attribute_id);
                $attributeName[] = $attribute->name;
                $attributeRawValue[] = $category->row_value;
                $categoryInstances[$categoryEntity->id] = array_combine($attributeName,$attributeRawValue);
              }
          }
          $categoryInstancesArr[$categoryEntity->id] = array('id'=> $categoryEntity->id ,'attributes'=> $categoryInstances[$categoryEntity->id]);
        }
      }
// dd($categoryInstances);
    $output = [
        'results' => [],
        'meta'    => [],
    ];

    // Get Results
    $output['results'] = $categoryInstancesArr;

    // Set Meta
    $output['meta'] = [
        'page'        => $page,
        'per_page'    => $per_page,
        'count'       => $categoryEntities->count(),
        'total_pages' => ceil($categoryEntities->count() / $per_page)
    ];

      return new EntityResource($output);
    }

    public function getActiveCategories($page=1, $per_page=10){
        return $this->getEntityAttribute('category','Active',$page=1, $per_page=10);
    }

    public function getActiveItems($category, $page=1, $per_page=10){
      $categoryAttribute = Attribute::where('name','item')->first();
      $status = Status::where('name','Active')->first();
      $categoryEntities = Entity::where('attribute_id',$categoryAttribute->id)->where('status_id',$status->id)->where('parent_id',$category)->get();
      $categoryInstancesArr = array();
      foreach ($categoryEntities as $categoryEntity) {
        $categories = Entity::where('parent_id',$categoryEntity->id)->get();
        $attributeName = array();
        $attributeRawValue = array();
        foreach ($categories as $category) {
            if(!empty($category->row_value)){
              $attribute = Attribute::findOrFail($category->attribute_id);
              $attributeName[] = $attribute->name;
              $attributeRawValue[] = $category->row_value;
              $categoryInstances[$categoryEntity->id] = array_combine($attributeName,$attributeRawValue);
            }
        }
        $categoryInstancesArr[$categoryEntity->id] = array('id'=> $categoryEntity->id ,'attributes'=> $categoryInstances[$categoryEntity->id]);
      }

      $output = [
          'results' => [],
          'meta'    => [],
      ];

      // Get Results
      $output['results'] = $categoryInstancesArr;

      // Set Meta
      $output['meta'] = [
          'page'        => $page,
          'per_page'    => $per_page,
          'count'       => $categoryEntities->count(),
          'total_pages' => ceil($categoryEntities->count() / $per_page)
      ];

      return new EntityResource($output);
    }
}
