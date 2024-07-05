<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleadoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Province;
use App\Models\Department;
use App\Models\CivilStatus;
use Exception;


class empleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleado = Employee::with(['province','department','civilStatus', 'position' ])->latest()->get();
        //return view('empleados.index',compact('empleado'));
        return view('empleado.index',['empleados' => $empleado]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
       //ojo esta parte es para el cruce de tablas 
        $provincias = Province ::latest() -> get();  //sino tiene estado la funcion es asi
        $departamentos = Department ::where('state', 1)->get();        
        $posiciones = Position::where('state', 1)->get();
        $estadosCiviles = CivilStatus ::latest() -> get ();
            //dd($departamentos , $posiciones);
        return view('empleado.create',compact('provincias', 'departamentos',
        'posiciones', 'estadosCiviles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpleadoRequest $request)
    {
        //dd ($request);
        try {
            DB::beginTransaction();
            $empleado = Employee::create($request->validated());   
            $empleado->save();
            DB::commit();
        }catch(Exception $e){
            //return $e;
            DB::rollBack();
        }
        return redirect()->route('empleados.index')->with('success', 'Empleado registrado!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $empleado)
    {
        return view('empleado.show',compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Employee $empleado)
    {
        $provincias = Province ::latest() -> get();  //sino tiene estado la funcion es asi
        $departamentos = Department ::where('state', 1)->get();        
        $posiciones = Position::where('state', 1)->get();
        $estadosCiviles = CivilStatus ::latest() -> get ();
            //dd($departamentos , $posiciones);
        return view('empleado.edit',compact('empleado','provincias', 'departamentos',
        'posiciones', 'estadosCiviles')); 
    

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( StoreEmpleadoRequest $request, Employee $empleado)
    {
        try{
            DB::beginTransaction();

            $empleado->fill([
                'ci' => $request->ci,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'sex' => $request->sex,
                'birth_date' => $request->birth_date,
                'direction' => $request->direction,
                'f_income' => $request->f_income,
                'f_exit' => $request->f_exit,  
                //'img_url' => $request->img_url,
                'province_id' => $request-> province_id,    
                'department_id' => $request->department_id,
                'civil_status_id' => $request -> civil_status_id,
                'position_id' => $request->position_id
            ]);

            $empleado->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $message = '';
        $empleado = Employee::find($id);

        if($empleado->state == 1){
            $empleado->update([
                'state' => 0
            ]);
            $message = 'Empleado eliminado';
        }else{
            $empleado->update([
                'state' => 1
            ]);
            $message = 'Empleado restaurado';
        }
        return redirect()->route('empleados.index')->with('success', $message);
    }
}