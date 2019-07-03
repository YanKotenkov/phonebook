<?php
/**
 * @var \forms\ContactForm $contactForm
 * @var array $fields
 * @var int $id
 */
?>
<div class="card">
    <div class="card-body">
        <table class="table table-hover table-condensed">
            <caption id="contact-detail-caption">
                Информация о контакте
                <button class="btn btn-primary js-show-edit-contact-form" data-id="<?= $id ?>">
                    Редактировать
                </button>
            </caption>
            <tbody>
            <?php foreach ($fields as $name => $value) : ?>
                <?php if ($name === 'userId') : ?>
                    <?php continue ?>
                <?php endif ?>
                <tr class="table-light">
                    <td><?= $contactForm->getLabel($name) ?></td>
                    <?php if ($name === 'photo') : ?>
                        <td>
                            <img
                                src="<?= "data:image/*;base64, " . base64_encode(stripslashes($value)) ?>"
                                alt=""
                                class="rounded img-fluid"
                            >
                        </td>
                    <?php else : ?>
                            <td><?= $value ?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
