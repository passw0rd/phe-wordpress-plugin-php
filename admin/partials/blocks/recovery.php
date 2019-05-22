<?php
use VirgilSecurityPure\Config\Form;
use VirgilSecurityPure\Config\Crypto;
?>

<div class="virgil-pure-global-section">
    <h3 class="virgil-pure-global-section-title">Recovery</h3>
    <hr class="virgil-pure-global-line"/>
    <p class="virgil-pure-rotate-desc">
        If you need to deactivate the Pure plugin, you can go through this Recovery process using your previously
        generated recovery key to restore the original password hashes. This will decrypt the password hashes, replace
        the Pure data with the decrypted will decrypt the password hashes, them back in your password database and
        remove the PHE data.
    </p>

    <form class="virgil-pure-credentials-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
          method="post">
        <div class="virgil-pure-global-field">
            <label class="virgil-pure-global-field-label" for="virgil-recovery-private-key">
                <?= Crypto::RECOVERY_PRIVATE_KEY ?>
            </label>
            <input type="file" name="recovery_private_key" required>
        </div>

        <input type="hidden" name="action" value="<?= Form::ACTION ?>">
        <input type="hidden" name="form_type" value="<?= Form::RECOVERY ?>">
        <?php wp_nonce_field('nonce', Form::NONCE) ?>
        <input type="submit" name="submit" id="submit" class="virgil-pure-global-button virgil-pure-global-submit"
               value="Start Recovery">
    </form>
</div>