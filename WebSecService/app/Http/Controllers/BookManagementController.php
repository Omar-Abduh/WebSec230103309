<?php

namespace App\Http\Controllers;

use App\Models\bookManagement;
use Illuminate\Http\Request;

class BookManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = bookManagement::all();
        return view('quizzes.bookManagment.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quizzes.bookManagment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer|min:4',
        ]);

        bookManagement::create($validatedData);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(bookManagement $bookManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bookManagement $bookManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bookManagement $bookManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bookManagement $bookManagement)
    {
        //
    }
}
