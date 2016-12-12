@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Cadastro de Estados</div>
    <br/>
    <div class="col-sm-3">
        <button type="button" id="btnNovo" class="btn btn-info" title="Novo">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
    </div>
    <br/>

    <div class="panel-body">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nome Estado</th>
                    <th>Sigla Estado</th>
                    <th class="col-sm-2">AÇÃO</th>
                </tr>
            </thead>

            <tbody id="conteudoestado">

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

            </tbody>
        </table>
    </div>
</div>
</div> <!-- /container -->

<!-- MODAL ESTADO --->
<div class="modal fade bs-example-modal-lg" id="modelGrudPadrao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Cadastro de Estados</h4>
            </div>
            <div class="modal-body form-horizontal">

                <form id="formPadrao" method="POST">

                    <input type="hidden" name="id_estado" id="id_estado">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-sm-2">*Nome Estado:</label>
                        <div class="col-sm-9">
                            <input type="text" name="nome_estado" id="nome_estado" class="form-control validate-required" maxlength="100">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-sm-2">*Sigla:</label>
                        <div class="col-sm-2">
                            <input type="text" name="sigla_estado" id="sigla_estado" class="form-control validate-required" maxlength="2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-sm-2">Histórico Estado:</label>
                        <div class="col-sm-9">
                            <textarea style="min-height: 100px;" name="historico_estado" id="historico_estado" class="form-control"></textarea>
                        </div>
                    </div>


                </form>

            </div>
            <div class="modal-footer">
                <div class="col-sm-3 col-sm-offset-8">
                    <button type="button" id="btnSalvarPadrao" class="btn btn-sm form-control btn-success ">Salvar</button>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    baseUrl = '<?php echo $baseUrl; ?>';
    appendHTML = false;

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btnNovo').click(function () {
            limparValidacao();
            $('#formPadrao input,textarea').val('');
            appendHTML = true;
            openModalUsuario();
        });
        $('#btnSalvarPadrao').click(function () {
            limparValidacao();
            if (validar() === 0) {
                save();
            } else {
                alert('Os campos com * são obrigatórios');
            }
        });
        atribuirEventos();
    });
    function openModalUsuario() {
        $('#modelGrudPadrao').modal();
    }

    function closeModalUsuario() {
        $('#modelGrudPadrao').modal('hide');
    }
    function find(id_padrao) {
        $.ajax({
            url: baseUrl + '/find',
            data: {id_padrao: id_padrao},
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data) {
                    $('#formPadrao').populate(data);
                    openModalUsuario();
                } else {
                    alert('Nenhum estado encontrado');
                }
            },
            error: function () {
                alert('Ocorreu um erro ao buscar o estado');
            }
        });
    }
    function save() {
        var dataUsuario = $('#formPadrao').serialize();
        $.ajax({
            url: baseUrl + '/save',
            data: dataUsuario,
            type: 'POST',
            dataType: 'json',
            success: function (r) {

                if (r.success !== undefined && r.success !== '') {
                    closeModalUsuario();
                    all();
                    alert(r.success);
                } else if (r.error !== undefined && r.error !== '') {
                    alert(r.error);
                } else {
                    alert('Ocorreu um erro ao salvar o estado');
                }

            },
            error: function () {
                alert('Ocorreu um erro ao salvar o estado');
            }
        });
    }

    function deletar(id_estado) {
        if (confirm("Deseja realmente exluir esse estado?")) {
            $.ajax({
                url: baseUrl + '/delete',
                data: {id_padrao: id_padrao},
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data.success !== '') {
                        var objeto = $('#linha' + id_padrao);
                        $(objeto).fadeOut(1500, function () {
                            $(this).remove();
                        });
                    } else {
                        alert(data.error);
                    }
                },
                error: function () {
                    alert('Ocorreu um erro ao excluir o estado');
                }
            });
        }
    }
    function atribuirEventos() {
        $('.btnEditar').unbind('click');
        $('.btnExcluir').unbind('click');

        $('.btnEditar').click(function () {
            id_padrao = $(this).attr('id_padrao');
            appendHTML = false;
            find(id_padrao);
        });
        $('.btnExcluir').click(function () {
            id_padrao = $(this).attr('id_padrao');
            deletar(id_padrao);
        });
    }

    function all() {
        $.ajax({
            url: baseUrl + '/all',
            type: 'GET',
            dataType: 'html',
            success: function (r) {
                $("#conteudoestado").html(r);
                atribuirEventos();
            },
            error: function () {
                alert('Ocorreu um erro ao listas o(s) estado(s)');
            }
        });
    }

    function validar() {
        var total = 0;
        var objeto = $("#formPadrao").find('.validate-required');
        objeto.each(function () {
            if ($(this).val() === '') {
                $(this).addClass('formError');
                total++;
            }
        });

        return total;
    }

    function limparValidacao() {
        $("#formPadrao").find('.validate-required').removeClass('formError');
    }

</script>

@endsection  