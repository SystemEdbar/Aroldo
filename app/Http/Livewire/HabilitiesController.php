<?php

namespace App\Http\Livewire;

use App\Models\Habilities;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HabilitiesController extends Component
{
    //definimos unas variables
    public $habilidades, $description, $id_habilidad;
    public $modal = false;

    public function render()
    {
        $this->habilidades = Habilities::where('id_user',Auth::id())->get();
        return view('livewire.habilidades');
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();
    }

    public function abrirModal() {
        $this->modal = true;
    }
    public function cerrarModal() {
        $this->modal = false;
    }
    public function limpiarCampos(){
        $this->description = '';
    }
    public function editar($id)
    {
        $habilidad = Habilities::findOrFail($id);
        $this->id_habilidad = $id;
        $this->description = $habilidad->description;
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Habilities::find($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente');
    }

    public function guardar()
    {
        $id_user= Auth::id();
        Habilities::updateOrCreate(['id'=>$this->id_habilidad],
            [
                'description' => $this->description,
                'id_user' => $id_user,
            ]);

         session()->flash('message',
            $this->id_habilidad ? '¡Actualización exitosa!' : '¡Alta Exitosa!');

         $this->cerrarModal();
         $this->limpiarCampos();
    }
}
