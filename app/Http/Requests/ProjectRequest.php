<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'subject' => 'required',
            'documents' => 'required|array',
            'description' => 'required',
            'documents.*' => [
                'required',
                "mimes:pdf,doc,docx,ppt,pptx,rar,zip,7z,tar.xz",
                'max:100000'
            ],
            'teacher_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên đồ án là bắt buộc',
            'subject.required' => 'Tên môn học là bắt buộc',
            'description.required' => 'Mô tả là bắt buộc',
            'documents.required' => 'File đồ án là bắt buộc',
            'documents.*.required' => 'File đồ án là bắt buộc',
            'documents.*.mimes' => 'File bắt buộc ở các định dạng sau: pdf, doc, docx, ppt, pptx, rar, zip, 7z, tar.xz',
            'documents.*.max' => 'File không quá 100MB',
        ];
    }

    // public function attributes()
    // {
    //     return [
    //         'name' => 'Tên đồ án',
    //         'subject' => 'Tên môn học',
    //         'documents' => 'File đồ án',
    //         'teacher_id' => 'Giáo viên'
    //     ];
    // }
}
