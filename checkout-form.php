<div id="myModalcheckout" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Checkout</h4>
            </div>
            <div class="modal-body">
                <?php
                echo do_shortcode('[woocommerce_checkout]');
                ?>
            </div>

        </div>
    </div>
</div>