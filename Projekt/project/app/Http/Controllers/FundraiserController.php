<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fundraiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class FundraiserController extends Controller
{
    public function __construct() {
        $this->middleware('verified')->only('create', 'edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fundraisers = Fundraiser::all();

        if(isset($_GET["amount_to_be_raised"])){
            if(isset($_GET['category'])) {
                $id = Category::where('name', $_GET['category'])->firstOrFail()->id;
                $fundraisers = $fundraisers->where('category_id', '=', $id);
            }
            if($_GET['stop_date'] != '' )
                $fundraisers = $fundraisers->where('stop_date','<=',$_GET['stop_date']);
            if($_GET['start_date'] != '' )
                $fundraisers = $fundraisers->where('start_date','<=',$_GET['start_date']);

            $fundraisers = $fundraisers->where('start_date','<=',$_GET['start_date']);
        }

        return view('fundraisers.index')->withFundraisers($fundraisers)->withCategories(Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fundraisers.create')->withCategories(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stop_date' => 'required|date|after:now',
            'amount_to_be_raised' => 'required|gt:0'
        ]);

        $fundraiser = new Fundraiser();
        $fundraiser->title = $request->title;
        $fundraiser->category_id = Category::where('name', $request->category)->firstOrFail()->id;
        $fundraiser->description = $request->description;
        $fundraiser->stop_date = $request->stop_date . " 23:59:59";
        $fundraiser->amount_raised = 0;
        $fundraiser->amount_to_be_raised = $request->amount_to_be_raised;
        $fundraiser->user_id = Auth::id();

        $fundraiser->save();

        return redirect()->route('fundraisers.show', $fundraiser);
    }

    /**
     * Display the specified resource.
     *
     * @param  Fundraiser $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function show(Fundraiser $fundraiser)
    {
        return view('fundraisers.show')->withFundraiser($fundraiser);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Fundraiser $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Fundraiser $fundraiser)
    {
        if (auth::id() == $fundraiser->user->id) {
            return view("fundraisers.edit")->withFundraiser($fundraiser)->withCategories(Category::all());
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Fundraiser $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fundraiser $fundraiser)
    {

        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stop_date' => 'required|date|after:now',
            'amount_to_be_raised' => 'required|gt:0'
        ]);

        $fundraiser->title = $request->title;
        $fundraiser->category_id = Category::where('name', $request->category)->firstOrFail()->id;
        $fundraiser->description = $request->description;
        $fundraiser->stop_date = $request->stop_date . " 23:59:59";
        $fundraiser->amount_to_be_raised = $request->amount_to_be_raised;
        $fundraiser->updated_at = \Carbon\Carbon::now()->toDateTimeString();

        $fundraiser->save();

        return redirect()->route('fundraisers.show', $fundraiser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Fundraiser $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fundraiser $fundraiser)
    {
        if(auth::id() != $fundraiser->user->id) {
            abort(403);
        }

        $fundraiser->delete();

        return redirect()->route('fundraisers.index');
    }

    public function filter(){
        return view('/fundraisers');
    }

}
