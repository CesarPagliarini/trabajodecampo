<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalSettingResource extends JsonResource
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
            'line' => $this->id,
            'professional' => $this->professional,
            'specialty' => $this->specialty->only('name', 'id', 'description'),
            'service' => $this->service->only('name', 'id', 'description'),
            'attention_place' => $this->attentionPlace->only('name', 'id' , 'description'),
            'time_unit' => $this->time_unit,
            'work_holiday' => $this->work_holiday,
            'show_amount' => $this->show_amount,
            'is_highlighted' => $this->is_highlighted,
            'currency' => $this->currency->only('name', 'id'),
            'amount' => $this->amount,
            'is_temporal' => $this->is_temporal,
        ];
    }
}
