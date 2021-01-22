<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Nominee;

class NomineeController extends Controller
{
    /**
     * Show all nominee data.
     * 
     * @return Inertia\Inertia
     */
    public function index ()
    {
        $nominees = Nominee::all();

        return Inertia::render('Nominee/index', ['nominees' => $nominees]);
    }

    /**
     * Show a requested nominee data.
     * 
     * @return Inertia\Inertia
     */
    public function show($id)
    {
        $nominee = Nominee::findOrFail($id);

        return Inertia::render('Nominee/details', ['nominee' => $nominee]);
    }

    /**
     * Show a create page for nominee
     * 
     * @return Inertia\Inertia
     */
    public function create()
    {
        return Inertia::render('Nominee/create');
    }

    /**
     * Store a user to database.
     * 
     * @return Inertia\Inertia
     */
    public function store()
    {
        $nominee = new Nominee;
        $nominee->name = request('name');
        $nominee->age = request('age');
        $nominee->class = request('class');
        $nominee->hobby = request('hobby');
        $nominee->description = request('description');
        $nominee->save();

        return redirect($nominee->path());
    }

    /**
     * Store a user to database.
     * 
     * @return Inertia\Inertia
     */
    public function update($id)
    {
        $nominee = Nominee::findOrFail($id);
        $nominee->name = request('name');
        $nominee->age = request('age');
        $nominee->class = request('class');
        $nominee->hobby = request('hobby');
        $nominee->description = request('description');
        $nominee->save();

        return redirect($nominee->path());
    }

    /**
     * Delete user from database
     * 
     * @return Inertia\Inertia
     */
    public function destroy($id)
    {
        $nominee = Nominee::findOrFail($id);
        $nominee->delete();

        return redirect('/nominees');
    }
}
