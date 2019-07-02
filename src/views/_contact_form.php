<?php
/**
 * @var ContactForm $contactForm
 */

use forms\ContactForm;
use lib\validators\PhoneValidator;
?>
<form id="contact-form" action="" method="post" enctype="multipart/form-data">
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
                <caption id="contact-edit-caption"></caption>
                <tbody>
                <tr class="table-light">
                    <td><label for="name"><?= $contactForm->getLabel('name') ?></label></td>
                    <td>
                        <input
                            id="name" type="text" name="name" value="<?= $contactForm->name ?>"
                            <?= $contactForm->isRequired('name') ? 'required' : '' ?>
                        >
                    </td>
                </tr>
                <tr class="table-light">
                    <td><label for="secondName"><?= $contactForm->getLabel('secondName') ?></label></td>
                    <td>
                        <input
                            id="secondName" type="text" name="secondName" value="<?= $contactForm->secondName ?>"
                            <?= $contactForm->isRequired('secondName') ? 'required' : '' ?>
                        >
                    </td>
                </tr>
                <tr class="table-light">
                    <td><label for="phone"><?= $contactForm->getLabel('phone') ?></label></td>
                    <td>
                        <input
                            id="phone" type="tel" name="phone" value="<?= $contactForm->phone ?>"
                            pattern=<?= PhoneValidator::PHONE_REGEX ?>
                            <?= $contactForm->isRequired('phone') ? 'required' : '' ?>
                        >
                    </td>
                </tr>
                <tr class="table-light">
                    <td><label for="email"><?= $contactForm->getLabel('email') ?></label></td>
                    <td>
                        <input
                            id="email" type="email" name="email" value="<?= $contactForm->email ?>"
                            <?= $contactForm->isRequired('email') ? 'required' : '' ?>
                        >
                    </td>
                </tr>
                <tr class="table-light">
                    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
                    <td><label for="photo"><?= $contactForm->getLabel('photo') ?></label></td>
                    <td>
                        <input
                            id="photo" type="file" name="photo"
                            <?= $contactForm->isRequired('photo') ? 'required' : '' ?>
                        >
                    </td>
                </tr>
                </tbody>
            </table>
            <button class="js-save-contact btn btn-success">Сохранить</button>
        </div>
    </div>
</form>
