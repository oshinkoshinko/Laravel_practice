<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//DBに保存用
use App\Models\ContactForm;
//クエリビルダ用
use Illuminate\Support\Facades\DB;
use App\Services\CheckFormData;
//フォームリクエスト呼び出し storeメソッドに記載
use App\Http\Requests\StoreContactForm;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //eloquent or ORマッパー all()でDBのデータ全て取得
        // $contacts = ContactForm::all();

        //クエリビルダ 指定したデータを取得
        $contacts = DB::table('contact_forms')
        ->select('id','your_name','title','created_at')
        ->orderBy('created_at', 'asc')
        ->paginate(1);

        //compactで変数をviewへ渡す
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactForm $request)
    {
        //ContactFormを初期化 DB保存
        $contact = new ContactForm;

        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        //保存
        $contact->save();
        //保存後にリダイレクト
        return redirect('contact/index');
        // dd($your_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact = ContactForm::find($id);

        $gender = CheckFormData::checkGender($contact);
        $age = CheckFormData::checkAge($contact);
        //compactは変数を複数渡せる
        return view('contact.show', compact('contact','gender','age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = ContactForm::find($id);

        return view('contact.edit', compact('contact'));
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
        //
                $contact = ContactForm::find($id);

                $contact->your_name = $request->input('your_name');
                $contact->title = $request->input('title');
                $contact->email = $request->input('email');
                $contact->url = $request->input('url');
                $contact->gender = $request->input('gender');
                $contact->age = $request->input('age');
                $contact->contact = $request->input('contact');
        
                //保存
                $contact->save();
                //保存後にリダイレクト
                return redirect('contact/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = ContactForm::find($id);
        $contact->delete();

        return redirect('contact/index');
    }
}
