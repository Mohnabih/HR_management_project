<?php

namespace App\Http\Resources;

use App\Models\Employee;
use App\Models\Founder;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "name"=>$this->name,
            $this->mergeWhen($this->manager_id != null,[
                'manager'=>new EmployeeResource(Employee::find($this->manager_id))
            ]),
            $this->mergeWhen($this->manager_id == null,[
                 'founder'=>FounderResource::collection($this->founder)
            ]),
        ];
    }
}
