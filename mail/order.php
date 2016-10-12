<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <th>Наименование</th>
        <th>Количество</th>
        <th>Цена</th>
        <th>Сумма</th>
        </thead>
        <tbody>
        <?php foreach($session['cart'] as $id=>$item){?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['qty'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['qty'] * $item['price'] ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="3">Итого:</td>
            <td colspan="1"><?= $session['cart.qty'] ?></td>
        </tr>
        <tr>
            <td colspan="3">На сумму:</td>
            <td colspan="1"><?= $session['cart.sum'] ?></td>
        </tr>
        </tbody>
    </table>
</div>


