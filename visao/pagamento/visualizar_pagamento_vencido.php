<!--  Modal content for the above example -->
<div class="modal fade" id="pagamentos-vencidos" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-hidden="true"></button>
            </div>
            <h4 class="modal-title text-center" id="myLargeModalLabel">Pagamentos a Vencer</h4>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Data Vencimento Pagamento</th>
                            <th scope="col">Serviço Realizado</th>
                            <th scope="col">Nome Cliente</th>
                            <th scope="col">Situação</th>
                        </tr>
                    </thead>
                    <tbody id="registro-pagamento-vencido">
                    </tbody>
                </table>

                <div class="alert alert-danger" role="alert" id="mensagem-falha-busca-pagamento-vencido">
                    <span id="corpo-mensagem-falha-busca-pagamento-vencido"></span>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->