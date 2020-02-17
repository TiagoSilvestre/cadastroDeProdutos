<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Category;
use App\Http\Resources\CategoryResource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => new CategoryResource(Category::find($this->category_id)),
            'title' => $this->title,
            'description' => $this->description,
            'image' =>  $this->image,
            'price' => $this->price
        ];
   
    }
}
