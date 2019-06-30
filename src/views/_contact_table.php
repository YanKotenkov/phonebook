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
?>
<table class="table table-bordered table-hover table-condensed">
    <caption id="contact-table-caption">Список контактов</caption>
    <thead>
    <tr>
        <th>
            <a
                href="/"
                class="js-sort-link"
                data-sort-param="name"
                data-sort-order="<?= $sortOrder == 'ASC' ? 'DESC' : 'ASC' ?>"
            >
                <?= $contactForm->getLabel('name') ?>
            </a>
        </th>
        <th>
            <a
                    href="/"
                    class="js-sort-link"
                    data-sort-param="secondName"
                    data-sort-order="<?= $sortOrder == 'ASC' ? 'DESC' : 'ASC' ?>"
            >
                <?= $contactForm->getLabel('secondName') ?>
            </a>
        </th>
        <th>
            <a
                    href="/"
                    class="js-sort-link"
                    data-sort-param="phone"
                    data-sort-order="<?= $sortOrder == 'ASC' ? 'DESC' : 'ASC' ?>"
            >
                <?= $contactForm->getLabel('phone') ?>
            </a>
        </th>
        <th>
            <a
                    href="/"
                    class="js-sort-link"
                    data-sort-param="email"
                    data-sort-order="<?= $sortOrder == 'ASC' ? 'DESC' : 'ASC' ?>"
            >
                <?= $contactForm->getLabel('email') ?>
            </a>
        </th>
        <th>
            <?= $contactForm->getLabel('photo') ?>
        </th>
        <th>
            <a
                    href="/"
                    class="js-sort-link"
                    data-sort-param="insDate"
                    data-sort-order="<?= $sortOrder == 'ASC' ? 'DESC' : 'ASC' ?>"
            >
                <?= $contactForm->getLabel('insDate') ?>
            </a>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($contactList as $id => $contact) : ?>
        <tr>
            <td><?= $this->encode($contact->name) ?></td>
            <td><?= $this->encode($contact->secondName) ?></td>
            <td><?= $this->encode($contact->phone) ?></td>
            <td><?= $this->encode($contact->email) ?></td>
            <td><?= $contact->photo ?></td>
            <td><?= $contact->insDate ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
