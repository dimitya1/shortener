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
            ->simplePaginate(5);

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
                'old_link' => 'url|required|min:14|max:500',
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
            ->with('successful link shorten', "Link \"{$link->old_link}\"
             was successfully shortened to \"{$savedLink->new_link}\"");
    }


    public function show(Link $link)
    {
        return view('show', ['link' => $link]);
    }


    public function edit(Link $link)
    {
        return view('edit', ['link' => $link]);
    }


    public function update(Link $link)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'old_link' => 'url|required|min:14|max:500',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('links.edit', ['link' => $link])
                ->withErrors($validator->errors());
        }

        if ($link->old_link === request()->get('old_link')) {
            return redirect()
                ->route('links.edit', ['link' => $link])
                ->with('nothing to update', 'Nothing to update!');
        } else {
            $link->old_link = request()->get('old_link');
            $link->save();
        }

        return redirect()
            ->route('links.index')
            ->with('successful link edit', 'Your link was successfully updated');
    }


    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()
            ->route('links.index')
            ->with('successful link delete', "Link was successfully deleted!");
    }
}

