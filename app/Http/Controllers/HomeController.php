<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Para ejecutar consultas
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\g_usutpro;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roles=Permission::all();
        $id_usuario=auth()->user()->id;
        //session(['id_compania' => '1']);
        $users = DB::select('select * from users', [1]);
        date_default_timezone_set('Mexico/General');
        $now=date("Y-m-d");
        $companias = DB::select("select gUC_usuario,gUC_cveCia,gOC_nombre,gUC_fecha from g_CiatCat,g_usutcat where gUC_cveCia = gOC_cveCia and gUC_usuario='".$id_usuario."'",[3]);
        return view('home',['companias'=>$companias],['now'=>$now]);
    }
    public function store(Request $request)
    {
        $datos=$request->all();
        $id_usuario=auth()->user()->id;
        $id_compania=$request->compania;
       
        $fecha =$request->fecha;
        $fechaproceso=$fecha;
        $mes=substr($fecha,5,6);
        $mes1=substr($mes,0,2);
        $anio=substr($fecha,0,4);
        date_default_timezone_set('Mexico/General');
        $now=date("Y-m-d");
        $borra_asignacion= DB::delete("delete from g_usutpro where gUP_cveCia ='".$id_compania."' and gUP_usuario='".$id_usuario."'");
        if($fecha!=$now)
        {
            $companias= DB::select("select gUC_fecha,gUC_usuario from g_usutcat where gUC_cveCia ='".$id_compania."' and gUC_usuario='".$id_usuario."'",[4]);
            foreach ($companias as $compania)
            {
                $cambio_fecha=$compania->gUC_fecha;
            }
            if($cambio_fecha==0)
            {
                $mensaje="No tienes permiso para cambiar fecha, debes de asignarte con la fecha actual";
            }
            else
            { 
                session(['id_compania' => $id_compania]);
                $mensaje="Asignación correcta";
              // $companias= DB::insert("insert into g_usutpro (gUP_usuario,gUP_terminal,gUP_cveCia,gUP_mespro,gUP_anopro,gUP_fecpro) values('".$id_usuario."',1,'".$id_compania."','".$mes1."','".$anio."','".$fechaproceso."')");
                /*
                $registro_usuario= new g_usutpro;
                $registro_usuario->gUP_usuario =$id_usuario;
                $registro_usuario->gUP_terminal ="1";
                $registro_usuario->gUP_cveCia =$id_compania;
                $registro_usuario->gUP_mespro =$mes;
                $registro_usuario->gUP_anopro =$anio;
                $registro_usuario->gUP_fecpro =$fechaproceso;
                $registro_usuario->save();
               */

                $registro_usuario=g_usutpro::create([
                    'gUP_usuario' =>$id_usuario,
                    'gUP_terminal' =>'1',
                    'gUP_cveCia' =>$id_compania,
                    'gUP_mespro' =>$mes1,
                    'gUP_anopro' =>$anio,
                    'gUP_fecpro' =>$fechaproceso
                ]);
                
            }
           
        }
        else{

            $mensaje="Asignación correcta";
            
            $registro_usuario=g_usutpro::create([
                'gUP_usuario' =>$id_usuario,
                'gUP_terminal' =>'1',
                'gUP_cveCia' =>$id_compania,
                'gUP_mespro' =>$mes1,
                'gUP_anopro' =>$anio,
                'gUP_fecpro' =>$fechaproceso,
            ]); 
            /*
            $registro_usuario= new g_usutpro;
            $registro_usuario->gUP_usuario =$id_usuario;
            $registro_usuario->gUP_terminal ="1";
            $registro_usuario->gUP_cveCia =$id_compania;
            $registro_usuario->gUP_mespro =$mes;
            $registro_usuario->gUP_anopro =$anio;
            $registro_usuario->gUP_fecpro =$fechaproceso;
            $registro_usuario->save();
            */
          // $companias= DB::insert("insert into g_usutpro (gUP_usuario,gUP_terminal,gUP_cveCia,gUP_mespro,gUP_anopro,gUP_fecpro) values('".$id_usuario."',1,'".$id_compania."','".$mes1."','".$anio."','".$fechaproceso."')");
            session(['id_compania' => $id_compania]);
        }
        
        
      //return $fechaproceso;
        return back()->with('flash',$mensaje);
    }
}
