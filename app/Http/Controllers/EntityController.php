<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity;
use App\Attribute;
use App\Status;
use App\File;
use App\Http\Resources\EntityResource;

class EntityController extends Controller
{
    protected $user;

    public function __construct()
    {
      $this->user = auth()->user();
    }
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
        'user_id' => $this->user->id,
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

    public function getEntityAttribute(Request $request=null, $attributeName, $statusName, $parentEntityId=null, $page=1, $per_page=10)
    {
      $categoryAttribute = Attribute::where('name',$attributeName)->first();
      $status = Status::where('name',$statusName)->first();
      $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $categoryInstances = array();
      $categoryInstancesArr = array();
      if($categoryAttribute){
        if(empty($parentEntityId)){
          $categoryEntities = Entity::where('attribute_id',$categoryAttribute->id)->where('status_id',$status->id)->whereNull('parent_id')->get();
        } else {
          if(parse_url($actual_link, PHP_URL_QUERY)){
            $categoryEntities = Entity::where('attribute_id',$categoryAttribute->id)->where('status_id',$status->id)->where('parent_id',$parentEntityId)->get();
          } else {
            $status = Status::where('name','Template')->first();
            $categoryEntities = Entity::where('attribute_id',$categoryAttribute->id)->where('status_id',$status->id)->where('parent_id',$parentEntityId)->get();
          }
        }
        foreach ($categoryEntities as $categoryEntity) {
          $categories = Entity::where('parent_id',$categoryEntity->id)->orderBy('display_order')->get();
          $attributeName = array();
          $attributeRawValue = array();
          $show = array('show'=>1);
          foreach ($categories as $category) {
              if(!empty($category->row_value)){
                $attribute = Attribute::findOrFail($category->attribute_id);
                $requestedName = $attribute->name;
                if(!empty($request) && $request->$requestedName){
                  if($request->$requestedName!=$category->row_value){
                    $show = array('show'=>0);
                  }
                }
                $attributeName[] = $attribute->name;
                $attributeRawValue[] = $category->row_value;
                $combinedAttributes = array_combine($attributeName,$attributeRawValue);
                $categoryInstances[$categoryEntity->id] = array_merge($show,$combinedAttributes);
              }
          }
          if(!empty($categoryInstances[$categoryEntity->id]) && $categoryInstances[$categoryEntity->id]['show']==1){
            $categoryInstancesArr[$categoryEntity->id] = array('id'=> $categoryEntity->id ,'attributes'=> $categoryInstances[$categoryEntity->id]);
          }
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
        'count'       => count($categoryInstancesArr),
        'total_pages' => ceil(count($categoryInstancesArr) / $per_page)
    ];

      return new EntityResource($output);
    }

    public function getActiveCategories($page=1, $per_page=10){
        return $this->getEntityAttribute(null, 'category', 'Active', null, $page=1, $per_page=10);
    }

    public function getActiveItems(Request $request, $category, $page=1, $per_page=10){
      return $this->getEntityAttribute($request, 'item', 'Active', $category, $page=1, $per_page=10);
    }

    public function getActiveEntity($entity,$entityId){
      $itemAttribute = Attribute::where('name',$entity)->first();
      if(!$itemAttribute){
        return response()->json(['message' => 'Not Found!'], 404);
      }
      $status = Status::where('name','Active')->first();

      $itemEntity = Entity::where('id',$entityId)->where('status_id',$status->id)->first();

      if($itemEntity && ($itemAttribute->id==$itemEntity->attribute_id)){
        $childInstances = array();
        $children = Entity::where('parent_id',$itemEntity->id)->orderBy('display_order')->get();
        $attributeName = array();
        $attributeRawValue = array();
        $show = array('show'=>1);
        foreach ($children as $child) {
            if(!empty($child->row_value)){
              $attribute = Attribute::findOrFail($child->attribute_id);
              $requestedName = $attribute->name;
              $attributeName[] = $attribute->name;
              $attributeRawValue[] = $child->row_value;
              $combinedAttributes = array_combine($attributeName,$attributeRawValue);
              $childInstances[$itemEntity->id] = array_merge($show,$combinedAttributes);
            }
        }
        $itemInstancesArr = array('row_value' => $itemEntity->row_value);
        if(sizeOf($childInstances)){
          $itemInstancesArr = array('id'=> $itemEntity->id ,'attributes'=> $childInstances[$itemEntity->id]);
        }

        return $itemInstancesArr;
      } else {
        return response()->json(['message' => 'Not Found!'], 404);
      }
    }

    public function storeEntity(Request $request, $entityType, $parentEntityId=null){
      $entityAttribute = Attribute::where('name',$entityType)->first();
      $entity = new Entity([
        'parent_id' => $parentEntityId,
        'attribute_id' => $entityAttribute->id,
        'status_id' => 1,
        'user_id' => $this->user->id
      ]);
      $entity->save();
      if($request->input()){
        $i=1;
        foreach ($request->input() as $key => $value) {
          $attribute = Attribute::where('name',$key)->first();
          $entityChild = new Entity([
            'attribute_id' => $attribute->id,
            'parent_id' => $entity->id,
            'display_order' => $i,
            'row_value' => $value,
            'status_id' => 1
          ]);
          $entityChild->save();
          $i++;
        }
      }
      if($request->file){
        $this->uploadFile($request);
      }
      return $this->getActiveEntity($entity,$entity->id);
    }

    public function storeCategory(Request $request){
      return $this->storeEntity($request,'category');
    }

    public function storeItem(Request $request, $parentEntityId){
      return $this->storeEntity($request,'item',$parentEntityId);
    }

    public function updateEntity(Request $request, $id){
      $entity = Entity::findOrFail($id);
      $entityAttribute = Attribute::findOrFail($entity->attribute_id);
      $entityArray = $request->input('attributes');
      if($entityArray){
        if($entityArray['show']){
          unset($entityArray['show']);
        }
        $i=1;
        foreach ($entityArray as $key => $value) {
          $attribute = Attribute::where('name',$key)->first();
          if($attribute){
            $entityChild = Entity::where('attribute_id',$attribute->id)->where('parent_id',$id)->first();
            if($entityChild){
              $entityChild->display_order = $i;
              $entityChild->row_value = $value;
              $entityChild->save();
            } else {
              $entityChild = Entity::create([
                  'attribute_id' => $attribute->id,
                  'parent_id' => $id,
                  'display_order' => $i,
                  'row_value' => $value,
                  'status_id' => 1
              ]);
            }
          }
          $i++;
        }
      }
      return $this->getActiveEntity($entityAttribute->name,$id);
    }

    protected function uploadFile(Request $request) {
        $file = Input::file('file');
        $filename = $file->getClientOriginalName();

        $path = hash( 'sha256', time());

        if(Storage::disk('uploads')->put($path.'/'.$filename,  File::get($file))) {
            $input['name'] = $filename;
            $input['type'] = $file->getClientMimeType();
            $input['path'] = $path;
            $input['size'] = $file->getClientSize();
            $input['user_id'] = $this->user->id;
            $input['entity_id'] = $request->entity_id;
            $file = File::create($input);

            return response()->json([
                'success' => true,
                'id' => $file->id
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);
    }
}
