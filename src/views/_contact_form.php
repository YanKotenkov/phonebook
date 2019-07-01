<?php
/**
 * @var ContactForm $contactForm
 */

use forms\ContactForm;

?>
<form id="contact-form" action="/add-contact" method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-body">
            <?php if (isset($errors)) : ?>
                <div class="errors border border-danger bg-danger py-2 px-3 rounded">
                    <?php foreach ($errors as $error) : ?>
                        <?php foreach ($error as $errorMessage) : ?>
                            <div><?= $errorMessage ?></div>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <table class="table table-hover table-condensed">
                <caption id="contact-detail-caption">Добавить контакт</caption>
                <tbody>
                <tr class="table-light">
                    <td><label for="name"><?= $contactForm->getLabel('name') ?></label></td>
                    <td><input id="name" type="text" name="name" value="<?= $contactForm->name ?>"></td>
                </tr>
                <tr class="table-light">
                    <td><label for="secondName"><?= $contactForm->getLabel('secondName') ?></label></td>
                    <td>
                        <input id="secondName" type="text" name="secondName" value="<?= $contactForm->secondName ?>">
                    </td>
                </tr>
                <tr class="table-light">
                    <td><label for="phone"><?= $contactForm->getLabel('phone') ?></label></td>
                    <td><input id="phone" type="text" name="phone" value="<?= $contactForm->phone ?>"></td>
                </tr>
                <tr class="table-light">
                    <td><label for="email"><?= $contactForm->getLabel('email') ?></label></td>
                    <td><input id="email" type="email" name="email" value="<?= $contactForm->email ?>"></td>
                </tr>
                <tr class="table-light">
                    <td><label for="photo"><?= $contactForm->getLabel('photo') ?></label></td>
                    <td><input id="photo" type="file" name="photo"></td>
                </tr>
                </tbody>
            </table>
            <button class="js-add-contact btn btn-success">Сохранить</button>
        </div>
    </div>
</form>
