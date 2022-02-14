<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\Tag;

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

        $tags = Tag::all();
    
        // dump($posts);
        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
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
        // dd($data);

        // AGGIUNTA IMG PER POST SE PRESENTE
        if(array_key_exists('cover', $data)) {
            // salva img in storage e ottenere la path del file caricato da salvare a db
            $img_path = Storage::put('posts-covers', $data['cover']);
            $data['cover'] = $img_path;
        }

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

        // Salvo in tabella pivot relazione del post creato con id dei tags
        if(array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);
        }

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

        dump($post->category); //Ricorda che è istanza singola, un oggetto

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

        $categories = Category::all();
        $tags = Tag::all();

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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

        // AGGIUNTA / UPDATE DEL POST SE PRESENTE
        if(array_key_exists('cover', $data)) {
            // remove if cover already exists
            if($post->cover) {
                Storage::delete($post->cover);
            }

            $data['cover'] = Storage::put('posts-covers', $data['cover']);
        }

        
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

            $post->update($data);

            // Update relazioni pivot tra post aggiornato e tags
            if(array_key_exists('tags', $data)) {
                // update tags (rows in pivot): aggiunta di nuovi id, rimozione di id, cambio di id
                $post->tags()->sync($data['tags']);
            } else {
                // nessun checkbox per tags selezionato nella form, quindi pulizia
                $post->tags()->detach();
            }

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
        // Prende il record con l'id selezionato
        $post = Post::find($id);

        // check presenza cover
        if($post->cover) {
            Storage::delete($post->cover);
        }

        // Cancella il record selezionato
        $post->delete();

        // Cancella anche relazione nella tabella pivot per non avere record orfani (se non avessimo onDelete nella migration)
        // $post->tags()->detach();
        
        // Redirect verso pagina gallery
        return redirect()->route('admin.posts.index')->with('delete', $post->title);
    }

    // Validation rules

    private function validation_rules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id', //Controllo se category id esiste nella tabella categories
            'tags'=> 'nullable|exists:tags,id',
            'cover' => 'nullable|file|mimes:jpeg, jpg, png',
        ];
    }

    private function validation_messages() {
        return [
            'required' => 'Remember to write the :attribute',
            'max' => 'Max :max characters allowed for the :attribute', 
            'category_id.exists' => 'The selected category doesn\'t exist.',
            'tag_id.exists' => 'The selected tag doesn\'t exist.'
        ];
    }
}