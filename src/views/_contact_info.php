<?php
/**
 * @var \forms\ContactForm $contactForm
 * @var array $fields
 */
?>
<div class="card">
    <div class="card-body">
        <table class="table table-hover table-condensed">
            <caption id="contact-detail-caption">Информация о контакте</caption>
            <tbody>
            <?php foreach ($fields as $name => $value) : ?>
                <tr class="table-light">
                    <td><?= $contactForm->getLabel($name) ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
