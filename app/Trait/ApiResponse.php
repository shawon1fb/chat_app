<?php

namespace App\Trait;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponse
{
    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'invalid data',
                'errors' => call_user_func_array('array_merge', array_values($validator->getMessageBag()->toArray())),

            ], 400)
        );
    }

}
