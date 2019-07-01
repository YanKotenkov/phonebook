<?php
/**
 * @var View $this
 * @var User $user
 * @var ContactForm $contactForm
 * @var ContactForm[] $contactList
 * @var string $sortParam
 * @var string $sortOrder
 */

use forms\ContactForm;
use lib\View;
use models\User;

$this->registerJsFile('contact');
?>
<div class="contacts-wrapper">
    <div class="contact-list">
        <?= $this->render('_contact_table', compact('contactForm', 'contactList', 'sortParam', 'sortOrder')) ?>
    </div>
    <div class="divide"></div>
    <div class="contact-info">
    </div>
    <div class="contact-form">
        <?= $this->render('_contact_form', compact('contactForm')) ?>
    </div>
</div>
