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

    public function getCategories()
    {
      $categoryAttribute = Attribute::where('name','category')->first();
      $status = Status::where('name','Active')->first();
      $categoryEntities = array();
      $categoryInstances = array();
      $categoryInstancesArr = array();
      $categoryIds = array();
      $categories = array();
      $attributeArr = array();
      if($categoryAttribute){
        $categoryEntities = Entity::where('attribute_id',$categoryAttribute->id)->where('status_id',$status->id)->get();
        foreach ($categoryEntities as $categoryEntity) {
          $categories = Entity::where('parent_id',$categoryEntity->id)->get();
          // $categoryIds = array('id'=> $categoryEntity->id);
          // $i=0;
          // $len=count($categories);
          foreach ($categories as $category) {
              $attribute = Attribute::findOrFail($category->attribute_id);
              // if(!empty($category->row_value)){
              //   ${'attributeArr'.$i} = array($attribute->name =>$category->row_value);
              //   $attributeArr = array_merge($attributeArr,${'attributeArr'.$i});
              // }
              // if($i==$len - 1){
              //     $categoryInstances = array_merge($categoryInstances,$categoryIds,$attributeArr);
              //     $categoryInstancesArr [] = $categoryInstances;
              // }
              // $i++;
              $categoryInstances[$categoryEntity->id][] = array($attribute->name =>$category->row_value);
          }
        }
      }

      return new EntityResource($categoryInstances);
    }
}
