<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryBook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;
use Throwable;

class LibraryBookController extends Controller
{
    use CommonCrudOperations;


    public function store(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'category_id'        => 'required|integer',
            'author_id'          => 'required|integer',
            'publication_id'     => 'required|integer',

            'book_code'          => 'required|string|max:255|unique:library_books,book_code,' . $id,
            'accession_no'       => 'nullable|string|max:255|unique:library_books,accession_no,' . $id,

            'book_name'          => 'required|string|max:255',

            'quantity'           => 'nullable|integer|min:0',
            'issued_quantity'    => 'nullable|integer|min:0',
            'damaged_quantity'   => 'nullable|integer|min:0',
            'lost_quantity'      => 'nullable|integer|min:0',

            'purchase_price'     => 'nullable|numeric|min:0',
            'selling_price'      => 'nullable|numeric|min:0',

            'publication_year'   => 'nullable|digits:4',

            'status'             => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $data = [
                'school_id'          => null,
                'session_id'         => activeSession()->id,

                'category_id'        => $request->category_id,
                'author_id'          => $request->author_id,
                'publication_id'     => $request->publication_id,

                'book_code'          => $request->book_code,

                'slug'               => Str::slug($request->slug ?: $request->book_name),

                'accession_no'       => $request->accession_no,
                'barcode'            => $request->barcode,

                'book_name'          => $request->book_name,
                'sub_title'          => $request->sub_title,

                'isbn_no'            => $request->isbn_no,
                'edition'            => $request->edition,
                'volume'             => $request->volume,
                'language'           => $request->language,

                'rack_no'            => $request->rack_no,
                'shelf_no'           => $request->shelf_no,

                'subject'            => $request->subject,
                'class_name'         => $request->class_name,

                'publication_year'   => $request->publication_year,
                'pages'              => $request->pages,

                'quantity'           => $request->quantity ?? 0,


                'purchase_price'     => $request->purchase_price ?? 0,
                'selling_price'      => $request->selling_price ?? 0,

                'description'        => $request->description,

                'status'             => $request->boolean('status'),
            ];

            if ($id) {

                $data['updated_by'] = Auth::id();

                $book = LibraryBook::findOrFail($id);

                if ($data['quantity'] > $book['quantity']) {
                    $quantityDiff = $data['quantity'] - $book['quantity'];
                    $data['available_quantity'] = $book['available_quantity'] + $quantityDiff;
                } else {
                    $quantityDiff = $book['quantity'] - $data['quantity'];
                    $data['available_quantity'] = $book['available_quantity'] - $quantityDiff;
                }

                $book->update($data);

                $message = 'Book updated successfully';
            } else {

                $data['created_by'] = Auth::id();

                $data['available_quantity'] = $data['quantity'];
                $data['issued_quantity'] = 0;
                $data['damaged_quantity'] = 0;
                $data['lost_quantity'] = 0;

                LibraryBook::create($data);

                $message = 'Book added successfully';
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $message
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            LibraryBook::class
        );
    }
    public function fetchWith()
    {
        return $this->commonFetch(
            LibraryBook::class,
            ['author', 'publication', 'category', 'issues', 'damages', 'stockLogs'],
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryBook::class,
            $request
        );
    }
    public function showWith(Request $request)
    {
        return $this->commonShow(
            LibraryBook::class,
            $request,
            ['author', 'publication', 'category']
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            LibraryBook::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryBook::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibraryBook::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryBook::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryBook::class,
            $request
        );
    }


    public function get_book_by_barcode_token(Request $request)
    {

        try {

            $barcode = $request->barcode_token;

            return $this->commonFetch(
                LibraryBook::class,
                ['author', 'publication', 'category', 'issues', 'damages', 'stockLogs'],
                ['barcode' => $barcode]
            );
        } catch (Throwable $th) {

            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ]);
        }
    }
}
