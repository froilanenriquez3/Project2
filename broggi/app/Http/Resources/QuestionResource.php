<?php

namespace App\Http\Resources;

use App\Models\Question;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'incidencies_id' => $this->incidencies_id,
            'questionText' => $this->questionText,
            'answers' => $this->answer
            //'answers' => Question::with('answer')->find($this->id)->answer
        ];
    }
}
