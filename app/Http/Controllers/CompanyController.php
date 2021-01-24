<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;




class CompanyController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $companies = Company::all();

        return view('index', ['companies' => $companies]);
    }

    public function store(Request $request){

         $validator = Validator::make($request->all(), [
            'name' => 'required|unique:companies',
            'inn' => 'required|digits:12',
            'general_information' => 'required',
            'ceo'=>'required',
            'adress' => 'required',
            'phone_number' => 'required',
         ]);
        if ($validator->fails()) {
            return redirect('')
                        ->withErrors($validator)
                        ->withInput($request->input());
        }

        Company::create($request->all());
        return redirect('');
    }

    public function show($id, Request $request) {
        $company = Company::find($id);
        $column_name = ['Компанию', 'Название', "ИНН","Общая иформация", "Генеральный директор", "Адрес", "Телефон"];
        if (Auth::check()) {
            $comments = Comment::where('company_id', $id)->where('user_id', $request->user()->id)->orderBy('created_at', 'DESC')->get();
            return view('detail', ['company' => $company, 'comments' => $comments, "column_name" =>$column_name]);
        }
        return view('detail', ['company' => $company, "column_name" =>$column_name]);
    }
    public function ajax($id ,Request $request){
        $column_name = ['Компанию', 'Название', "ИНН","Общая иформация", "Генеральный директор", "Адрес", "Телефон"];
        $comment = New Comment;
        $comment->user_id = $request->user()->id;
        $comment->company_id = $request->company_id;
        $comment->column_id = $request->column_id;
        $comment->comment = $request->comment;
        $comment->save();
        $data = [(string)$comment->created_at, $column_name[$comment->column_id]];
        return ($data);
    }
    
}