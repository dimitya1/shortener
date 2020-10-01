<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\URL;
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
                'long_link' => 'url|required|min:14|max:500',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('links.create')
                ->withErrors($validator->errors());
        }

        $link = new Link();
        $link->user_id = auth()->id();
        $link->long_link = request()->get('long_link');
        $link->save();

        return redirect()
            ->route('links.index')
            ->with('successful link shorten', "Link " . $link->long_link .
             " was successfully shortened to " . URL::to($link->id));
    }


    public function show(Link $link)
    {
        $statistics = $link->statistics()->orderBy('created_at', 'desc')->get();
        return view('show', ['link' => $link, 'statistics' => $statistics]);
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
                'long_link' => 'url|required|min:14|max:500',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('links.edit', ['link' => $link])
                ->withErrors($validator->errors());
        }

        if ($link->long_link === request()->get('long_link')) {
            return redirect()
                ->route('links.edit', ['link' => $link])
                ->with('nothing to update', 'Nothing to update!');
        } else {
            $link->long_link = request()->get('long_link');
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

