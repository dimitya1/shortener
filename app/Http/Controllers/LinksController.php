<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Validator;

final class LinksController
{
    public function index()
    {
        $links = Link::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('links', ['links' => $links]);
    }

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'old_link' => 'required|min:10|max:255',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('links.create')
                ->withErrors($validator->errors());
        }

        $link = new Link();
        $link->user_id = auth()->id();
        $link->old_link = request()->get('old_link');
        $link->save();
        $savedLink = Link::where('old_link', request()->get('old_link'))
            ->orderBy('created_at', 'desc')->first();
        $savedLink->new_link = 'http://localhost/' . $savedLink->id;
        $savedLink->save();

        return redirect()
            ->route('links.index')
            ->with('successful link shorten', "Link \"{$link->old_link}\" was successfully shortened");
    }
}

