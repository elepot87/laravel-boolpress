<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        dump($posts);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        // 1 parametro: set regole di validazione
        // 2 parametro: customizzare messaggio di errore (se si vuole)
        // $request->validate(
        //     [
        //     'title' => 'required|max:255',
        //     'content' => 'required',
        //     ], 
        //     [
        //     'required' => 'Remember to write the :attribute',
        //     'max' => 'Max :max characters allowed for the :attribute',
        //     ]
        // );

        $request->validate($this->validation_rules(), $this->validation_messages());
        
        $data = $request->all();
        dump($data);

        // Crea nuovo post
        $new_post = new Post();

        // Generazione slug univoca
        $slug = Str::slug($data['title'], '-');
        $count = 1;
        // Eseguo il ciclo se ho trovato un post con lo slug attuale
        while(Post::where('slug', $slug)->first()) {
            // Generare nuovo slug con contatore
            $slug .= '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        $new_post->fill($data); //Fare fillable nel model
        $new_post->save(); //Salvo a db

        //  redirect verso pagina dettaglio
        return redirect()->route('admin.posts.show', $new_post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (! $post) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validazione
        $request->validate($this->validation_rules(), $this->validation_messages());
        
        // Colleziono dati che arrivano dal form
        $data = $request->all();
        
        // 1.Ottenere il record da aggiornare 
        $post = Post::find($id);
        
        // 2.Update dello slug SOLO se il titolo è cambiato
        if($data['title'] != $post->title) {
            $slug = Str::slug($data['title'], '-');
            $count = 1;
            $base_slug = $slug;
        // Eseguo il ciclo se ho trovato un post con lo slug attuale
            while(Post::where('slug', $slug)->first()) {
            // Generare nuovo slug con contatore
                $slug .= '-' . $count;
                $count++;
            }
                $data['slug'] = $slug;
            }
            else {
                $data['slug'] = $post->slug;
            }

            $post->update();

         //redirect verso pagina dettaglio aggiornato
        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Validation rules

    private function validation_rules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
        ];
    }

    private function validation_messages() {
        return [
            'required' => 'Remember to write the :attribute',
            'max' => 'Max :max characters allowed for the :attribute',
        ];
    }
}