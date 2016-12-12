<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Estados;
use App\PermissoesUsuarios;
use Exception;

/**
 * Description of EstadoController
 *
 * @author eric
 */
class EstadoController extends Controller {

    private $estados;
    private $data;
    private $baseUrl;

    public function __construct() {
        $this->middleware('auth');
        $this->estados = new Estados();
        $this->baseUrl = url('estado');
    }

    public function index() {

        $this->data = $this->estados->getDataGrid();
        return view('admin/estado/index')->with('dataGrid', $this->data)->with('baseUrl', $this->baseUrl);
    }

    public function all() {
        $this->data = $this->estados->getDataGrid();
        return view('admin/estado/all')->with('dataGrid', $this->data);
    }

    public function find(Request $request) {
        //$request = request();
        $this->data = array();
        $id = $request->input('id_padrao');
        if (!empty($id)) {
            $this->data = $this->estados->find($id);
        }
        echo json_encode($this->data);
    }

    public function save(Request $request) {
        $populateForm = array();
        $populateForm['success'] = '';
        $populateForm['error'] = '';

        try {

            $input = $request->all();
            if (!empty($input['csrf-token'])) {
                unset($input['csrf-token']);
            }

            /**
              if (Gate::denies('save',  Auth()->user(),  $this->userRoles)) {
              $populateForm['error'] = 'Você não possui permissão para essa ação';
              echo json_encode($populateForm);
              die;
              }
             * 
             */
            if (empty($input)) {
                $populateForm['error'] = "Dados requeridos não informados";
            } else {

                if (!empty($input['id_estado'])) {
                    $this->estados = Estados::find($input['id_estado']);
                    $this->estados['nome_estado'] = $input['nome_estado'];
                    $this->estados['sigla_estado'] = $input['sigla_estado'];
                    $this->estados['historico_estado'] = $input['historico_estado'];
                    $this->estados->save();
                } else {
                    Estados::create($input);
                }

                $populateForm['success'] = 'Salvo com sucesso';
            }
        } catch (Exception $ex) {
            $populateForm['error'] = "Falha ao salvar: " . $ex->getMessage();
            echo json_encode($populateForm);
        }

        echo json_encode($populateForm);
    }

    public function delete(Request $request) {
        $populateForm = array();
        $populateForm['success'] = '';
        $populateForm['error'] = '';

        try {
            $id = $request->input('id_padrao');

            if (empty($id)) {
                $populateForm['error'] = 'Código não informado';
            } else {
                Estados::find($id)->delete();
                $populateForm['success'] = 'Excluído com sucesso';
            }
        } catch (Exception $ex) {
            $populateForm['error'] = "Falha ao excluir: " . $ex->getMessage();
            echo json_encode($populateForm);
        }

        echo json_encode($populateForm);
    }

}
