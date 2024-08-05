<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJugadorRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Player;
use App\Models\Province;
use App\Models\Team;
use App\Models\League;
use App\Models\Category;
use Exception;

class jugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jugadores = Player::with(['province','team','league','category'])->latest()->get();
        return view('jugadore.index',compact('jugadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Team::where('state',1)->get();
        $provincias = Province::get();
        $ligas = League::where('state',1)->get();
        $categorias = Category::where('state',1)->get();
        return view('jugadore.create',compact('equipos','provincias','ligas','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJugadorRequest $request)
    {
        try {
            DB::beginTransaction();
    
            // Crear una nueva instancia de Player
            $jugadore = new Player();
    
            // Validar y obtener los datos validados
            $validatedData = $request->validated();
    
            // Manejar el archivo de la imagen
            if ($request->hasFile('img_url')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $jugadore->hanbleUploadImage($request->file('img_url'));
                $validatedData['img_url'] = $name;
            } else {
                $validatedData['img_url'] = null;
            }

            $validatedData['own'] = $request->has('own') ? 1 : 0;
            $validatedData['booster'] = $request->has('booster') ? 1 : 0;
            $validatedData['youth'] = $request->has('youth') ? 1 : 0;
            $validatedData['certified'] = $request->has('certified') ? 1 : 0;
    
            // Llenar el modelo con los datos validados
            $jugadore->fill($validatedData);
    
            // Guardar el jugador en la base de datos
            $jugadore->save();
    
            // Obtener el equipo al que pertenece el jugador y actualizar el conteo de jugadores
            $team = Team::find($jugadore->team_id);
            if ($team) {
                $team->increment('player_number');
            }
    
            // Confirmar la transacción
            DB::commit();
    
            // Redireccionar con un mensaje de éxito
            return redirect()->route('jugadores.index')->with('success', 'Jugador registrado!');
        } catch (Exception $e) {
            dd($e);
            // Revertir la transacción en caso de error
            DB::rollBack();
    
            // Manejar el error (puedes redireccionar con un mensaje de error o registrar el error)
            return redirect()->route('jugadores.index')->with('error', 'Hubo un problema al registrar el Jugador.');
        }
    }

    public function carnet()
    {
        // Obtener todos los jugadores
        $jugadores = Player::with(['province', 'team', 'league', 'category'])->latest()->get();

        // Generar el PDF
        $pdf = Pdf::loadView('jugadore.carnet', compact('jugadores'));

        // Retornar el PDF
        return $pdf->stream('carnets.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $jugadore)
    {
        return view('jugadore.show',compact('jugadore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $jugadore)
    {
        $equipos = Team::where('state',1)->get();
        $provincias = Province::get();
        $ligas = League::where('state',1)->get();
        $categorias = Category::where('state',1)->get();
        return view('jugadore.edit',compact('equipos','provincias','ligas','categorias','jugadore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJugadorRequest $request, Player $jugadore)
    {
        try {
            DB::beginTransaction();

            // Manejar el archivo del logo
            if ($request->hasFile('img_url')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $jugadore->hanbleUploadImage($request->file('img_url'));
                //eliminar si existe imagen
                if (Storage::disk('public')->exists('/jugadores/' . $jugadore->img_url)) {
                    Storage::disk('public')->delete('/jugadores/' . $jugadore->img_url);
                }
            } else {
                $name = $jugadore->img_url;
            }

            $jugadore->fill([
                'dni' => $request->dni,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'sexo' => $request->sexo,
                'birthday' => $request->birthday,
                'position' => $request->position,
                'img_url' => $name,
                'own' => $request->own ? 1 : 0,
                'booster' => $request->booster ? 1 : 0,
                'youth' => $request->youth ? 1 : 0,
                'certified' => $request->certified ? 1 : 0,
                'observation' => $request->observation,
                'f_from' => $request->f_from,
                'f_until' => $request->f_until,
                'province_id' => $request->province_id,
                'team_id' => $request->team_id,
                'league_id' => $request->league_id,
                'category_id' => $request->category_id,
            ]);

            $jugadore->save();

            // Confirmar la transacción
            DB::commit();
        } catch (Exception $e) {
        }
        return redirect()->route('jugadores.index')->with('success', 'Jugador actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $jugadore = Player::find($id);

        if ($jugadore->state == 1) {
            $jugadore->update([
                'state' => 0
            ]);
            $message = 'Jugador desabilitado';
        } else {
            $jugadore->update([
                'state' => 1
            ]);
            $message = 'Jugador restaurado';
        }
        return redirect()->route('jugadores.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $jugadore = Player::find($id);
        $team = Team::find($jugadore->team_id);

        if ($jugadore) {
            try {
                DB::beginTransaction();

                // Eliminar la imagen si existe
                if (Storage::disk('public')->exists('jugadores/' . $jugadore->img_url)) {
                    Storage::disk('public')->delete('jugadores/' . $jugadore->img_url);
                }

                // Eliminar el registro del club
                $jugadore->delete();

                if ($team) {
                    $team->decrement('player_number');
                }

                DB::commit();

                return redirect()->route('jugadores.index')->with('success', 'Jugador eliminado definitivamente');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('jugadores.index')->with('error', 'Hubo un problema al eliminar el Jugador.');
            }
        }

        return redirect()->route('jugadores.index')->with('error', 'El Jugador no fue encontrado');
    }


}
