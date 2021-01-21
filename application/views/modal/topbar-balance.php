<div id="topbar-balance" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Баланс</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <h5 class="border-bottom pb-2 balance">Ваш баланс: <?php echo $this->session->userdata('UserBalance'); ?> руб.</h5>
                <h5>История транзакций:</h5>

                <table class="border w-100 text-center">
                    <tr>
                        <td class="border">Сервис</td>
                        <td class="border">ID</td>
                        <td class="border">Статус</td>
                        <td class="border">Дата</td>
                    </tr>

                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td class="border"><?php echo $transaction->payment_service; ?></td>
                            <td class="border"><?php echo $transaction->billId; ?></td>
                            <td class="border">

                                <?php if ($transaction->status != 'PAID'): ?>
                                    <span style="display: inline-block; width: 4px; height: 4px; background: red; vertical-align: middle; border-radius: 50%;"></span>
                                <?php else: ?>
                                    <span style="display: inline-block; width: 4px; height: 4px; background: green; vertical-align: middle; border-radius: 50%;"></span>
                                <?php endif; ?>
                                <?php echo $transaction->status; ?>
                            <td class="border"><?php echo $transaction->date; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<style>
    p.error-item { color: #e84b4b; }
</style>
