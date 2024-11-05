<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Filescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notaprensa($file)
    {
        $rutaDeArchivo = storage_path() . '/app/public/notas-prensa/' . $file;
        //return $rutaDeArchivo;
        return response()->file($rutaDeArchivo);
    }    
    public function avatar($file)
    {
        $rutaDeArchivo = storage_path() . '/app/avatar/' . $file;
        //return $rutaDeArchivo;
        return response()->file($rutaDeArchivo);
    }
    public function enlaceref($file)
    {
        $rutaDeArchivo = storage_path() . '/app/public/enlaceref/' . $file;
        //return $rutaDeArchivo;
        return response()->file($rutaDeArchivo);
    }    
    public function logos($file)
    {
        $rutaDeArchivo = storage_path() . '/app/public/logos/' . $file;
        //return $rutaDeArchivo;
        return response()->file($rutaDeArchivo);
    }    
    public function popup($file)
    {
        $rutaDeArchivo = storage_path() . '/app/public/popup/' . $file;
        //return $rutaDeArchivo;
        return response()->file($rutaDeArchivo);
    }    
    public function fag($file)
    {
        $rutaDeArchivo = storage_path() . '/app/public/fag/' . $file;
        return response()->file($rutaDeArchivo);
    }    
    public function slider($file)
    {
        $rutaDeArchivo = storage_path() . '/app/public/slider/' . $file;
        //return $rutaDeArchivo;
        return response()->file($rutaDeArchivo);
    }    
    public function seccion($file)
    {
        $rutaDeArchivo = storage_path() . '/app/public/seccion/' . $file;
        //return $rutaDeArchivo;
        return response()->file($rutaDeArchivo);
    }    
    public function files($file)
    {
        $rutaDeArchivo = storage_path() . '/app/public/' . $file;
        //return $rutaDeArchivo;
        return response()->file($rutaDeArchivo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
