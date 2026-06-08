<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCmcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $city = request('city');
        $type = request('type');
        $secteur = request('secteur');
        $date = request('date');

        $opportunities = Opportunity::query();

        if ($city) {
            $opportunities->where('city', 'like', "%$city%");
        }

        if ($type) {
            $opportunities->where('type', 'like', "%$type%");
        }

        if ($secteur) {
            $opportunities->where('secteur', 'like', "%$secteur%");
        }

        if ($date) {
            $opportunities->where('date', 'like', "%$date%");
        }

        $opportunities = $opportunities->get();
        return view('all', compact('opportunities'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add-par');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        // create a new partenaire use creaete method
        $partenaire = Partenaire::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,   
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show form to add usercmc
        return view('add-usercmc');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function save(string $id)
    {
        // save infos of usercmc in database add validate and create method to save data in database
        $request->validate([
            'post' => 'required|string|max:255',
        ]); 
        $usercmc = UserCmc::create([
            'post' => $request->post,
        ]);
        return redirect()->back()->with('success', 'Your message has been sent successfully!');

        
    }

    // edit function
        public function edit(string $id)
        {
            //show form to edit partner
            $partenaire = Partenaire::find($id);
            return view('edit-par', compact('partenaire'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update partner
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);
        $partenaire = Partenaire::find($id);
        $partenaire->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        return redirect()->back()->with('success', 'Partner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partenaire = Partenaire::find($id);
        $partenaire->delete();
        return redirect()->back()->with('success', 'Partner deleted successfully!');
    }

}
