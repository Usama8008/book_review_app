<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books= Book::orderBy('created_at','DESC');
        if(!empty($request->keyword)){
           $books->where('title','LIKE','%'. $request->keyword .'%');
        }
        $books= $books->paginate(10);

        return view('Account.book.list',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Account.book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'title'=> 'required|min:3',
            'author'=> 'required|min:3',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg',
            'book_pdf' => 'nullable|mimes:pdf', 

        ]);

        if($validator->fails()){
            return redirect()->route('book.create')->withInput()->withErrors($validator);
        }
        $imageName=null;
        $pdfName = null;
        // upload book image here
        if ($request->hasFile('image')) {
            $image = $request->file('image'); 
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/books'), $imageName);

            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/books/'.$imageName));
            $img->resize(990,1400);
            $img->save(public_path('uploads/books/thumb/'.$imageName));    
        }
            // upload book pdf here
        if ($request->hasFile('book_pdf')) {
                $pdf = $request->file('book_pdf');
                
                // Get a sanitized title to use in the filename, replacing spaces or special characters
                $bookTitle = preg_replace('/[^A-Za-z0-9\-]/', '', $request->title);
                $pdfName = $bookTitle . '_' . time() . '.' . $pdf->getClientOriginalExtension();
                
                $pdf->move(public_path('uploads/books/book_pdf'), $pdfName);
        }
            
        Book::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'description'=>$request->description,
            'image'=>$imageName,
            'book_pdf'=>$pdfName,
            'status'=>$request->status,
        ]);
        return redirect()->route('book.index')->with('success','Book Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book=Book::findorfail($id);
        return view('Account.book.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'book_pdf' => 'nullable|mimes:pdf',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('book.edit', $book->id)->withInput()->withErrors($validator);
        }
    
        // Initialize variables to store new file names
        $imageName = $book->image;
        $pdfName = $book->book_pdf;
    
        // Handle image file upload
        if ($request->hasFile('image')) {
            // Delete the old image files
            File::delete(public_path('uploads/books/'.$book->image));
            File::delete(public_path('uploads/books/thumb/'.$book->image));
    
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/books'), $imageName);
    
            // Create a thumbnail for the image
            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/books/' . $imageName));
            $img->resize(990,1400);
            $img->save(public_path('uploads/books/thumb/' . $imageName));
        }
    
        // Handle PDF file upload
        if ($request->hasFile('book_pdf')) {
            // Delete the old PDF file
            File::delete(public_path('uploads/books/book_pdf/'.$book->book_pdf));
    
            // Sanitize title for PDF filename
            $bookTitle = preg_replace('/[^A-Za-z0-9\-]/', '', $request->title);
            $pdf = $request->file('book_pdf');
            $pdfName = $bookTitle . '_' . time() . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('uploads/books/book_pdf'), $pdfName);
        }
    
        // Update the book record with the new data, preserving unchanged files
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image' => $imageName,
            'book_pdf' => $pdfName,
            'status' => $request->status,
        ]);
    
        return redirect()->route('book.index')->with('success', 'Book Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book= Book::findorfail($id);
        File::delete(public_path('uploads/books/'.$book->image));
        File::delete(public_path('uploads/books/thumb/'.$book->image));
        File::delete(public_path('uploads/books/book_pdf/'.$book->book_pdf));
        $book->delete();
        return redirect()->route('book.index')->with('success','You successfully Deleted This book');
        
    }


    // this will download the book
    public function download($id)
    {
        // Fetch the book record by ID
        $book = Book::find($id);
    
        // Check if the book exists
        if (!$book) {
            return redirect()->route('detail',$id)->with('error', 'Book not found.');
        }
    
        // Check if the book has an associated PDF
        if (!$book->book_pdf) {
            return redirect()->route('detail',$id)->with('error', 'PDF not found for this book.');
        }
    
        // Define the path to the PDF
        $filePath = public_path('uploads/books/book_pdf/'. $book->book_pdf);
    
        // Check if the file exists in the specified path
        if (!file_exists($filePath)) {
            return redirect()->route('detail',$id)->with('error', 'File does not exist on the server.');
        }
    
        // If all checks pass, proceed to download the file
        return response()->download($filePath);
    }
    

}
