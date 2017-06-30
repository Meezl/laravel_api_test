<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;

class QuoteController extends Controller
{
    public function postQuote(Request $request){
        $quote = new Quote();
        /** @var  $inputs
         * $inputs = $request->all(); ###shortcut
         * $quote->create($inputs);
         * */
        $quote->content = $request->input('content');
        $quote->author = $request->input('author');
        $quote->save();

        return response()->json(['quote' => $quote, 201]);
    }

    public function getQuotes(){
        $quotes = Quote::all();
        $response = ['quotes' => $quotes ];
        return response()->json($response,200);
    }

    public function deleteQuote($id) {
        $quote = Quote::find($id);
        $quote->delete();
        return response()->json(['message' => 'Quote Deleted', 200]);
    }

    public function updateQuote($id, Request $request){
        $quote = Quote::find($id);
        if(!$quote){
            return response()->json(['message' => 'Quote Not found!!', 404]);
        }
        $quote->content = $request->input('content');
        $quote->author = $request->input('author');
        $quote->update();
        return response()->json(['quote' => $quote, 201]);
    }
}
