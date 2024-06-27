<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Exceptions\InvalidArgumentException;
use Illuminate\Validation\ValidationException;

class DataService
{
    public function create(array $data)
    {
        $type = "";
        switch ($data['type']) {
            case 'invoice':
                $type = 'invoice';
                break;
            case 'customer':
                $type = 'customer';
                break;
        }
        $this->validateData($type, $data);

        $modelClass = $this->getModelClass($type);

        return $modelClass::create($data);
    }

    public function edit(array $data)
    {
        $type = "";
        switch ($data['type']) {
            case 'invoice':
                $type = 'invoice';
                break;
            case 'customer':
                $type = 'customer';
                break;
        }
        $this->validateData($type, $data);

        $modelClass = $this->getModelClass($type);
        return $modelClass::find($data['id'])->update($data);
    }
    public function load(array $data)
    {
        $type = "";
        switch ($data['type']) {
            case 'invoice':
                $type = 'invoice';
                break;
            case 'customer':
                $type = 'customer';
                break;
        }

        $modelClass = $this->getModelClass($type);
        $view = $this->getView($type);
        $data = $modelClass::orderBy('created_at', 'desc')->get();
        $data2 =  view($view, compact('data'))->render();
        return response()->json(['data' => $data2]);
    }
    ///Validating the data for different data types

    private function validateData(string $type, array $data)
    {
        $validationRules = $this->getValidationRules($type);

        $validator = Validator::make($data, $validationRules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    ///Calling Models for different data types
    private function getModelClass(string $type): string
    {
        $map = [
            'invoice' => Invoice::class,
            'customer' => Customer::class,
        ];

        if (!array_key_exists($type, $map)) {
            throw new InvalidArgumentException("Unsupported data type: $type");
        }

        return $map[$type];
    }
    private function getView(string $type): string
    {
        $map = [
            'invoice' => 'partials._get_invoices',
            'customer' => 'partials._get_customers',
        ];

        if (!array_key_exists($type, $map)) {
            throw new InvalidArgumentException("Unsupported data type: $type");
        }

        return $map[$type];
    }



    ///Validation rules for different data types
    private function getValidationRules(string $type): array
    {
        $map = [
            'invoice' => [
                'customer_id' => 'required',

            ],
            'customer' => [
                'name' => 'required',
            ],
            // Add validation rules for other supported types here
        ];
        if (!array_key_exists($type, $map)) {
            throw new InvalidArgumentException("Unsupported data type: $type");
        }
        return $map[$type];
    }
}
