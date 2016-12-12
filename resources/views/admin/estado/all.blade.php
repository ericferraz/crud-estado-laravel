 @foreach ($dataGrid as $u) 

                <tr id="linha{{$u->id_estado}}">
                    <td>{{$u->nome_estado}}</td>
                    <td>{{$u->sigla_estado}}</td>

                    <td>
                        <button type="button"  id_padrao="{{$u->id_estado}}" class="btn btn-info btnEditar" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>

                        <button type="button" id_padrao="{{$u->id_estado}}" class="btn btn-danger btnExcluir" title="Excluir">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
                @endforeach