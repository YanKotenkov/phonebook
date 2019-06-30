<?php
/**
 * @var View $this
 * @var \models\User $user
 * @var \forms\ContactForm $contactForm
 * @var \forms\ContactForm[] $contactList
 * @var string $sortParam
 * @var string $sortOrder
 */
use lib\View;
$this->registerJsFile('contact')
?>
<div class="contact-list">
    <?= $this->render('_contact_table', compact('user', 'contactForm', 'contactList', 'sortParam', 'sortOrder')) ?>
</div>
