<?php

Breadcrumbs::for('admin.forms.index', function ($trail) {
    $trail->push('Forms', route('admin.forms.index'));
});

Breadcrumbs::for('admin.forms.show', function ($trail, $form) {
    $trail->parent('admin.forms.index');
    $trail->push($form->title, route('admin.forms.show', $form));
});

Breadcrumbs::for('admin.forms.create', function ($trail) {
    $trail->parent('admin.forms.index');
    $trail->push('Create New', route('admin.forms.create'));
});

Breadcrumbs::for('admin.forms.edit', function ($trail, $form) {
    $trail->parent('admin.forms.show', $form);
    $trail->push('Edit', route('admin.forms.edit', $form));
});

Breadcrumbs::for('admin.submissions.index', function ($trail, $form) {
    $trail->parent('admin.forms.show', $form);
    $trail->push('Submissions', route('admin.submissions.index', $form));
});

Breadcrumbs::for('admin.submissions.show', function ($trail, $form, $field) {
    $trail->parent('admin.submissions.index', $form);
    $trail->push('Submission', route('admin.submissions.show', [$form, $field]));
});

Breadcrumbs::for('admin.fields.index', function ($trail, $form) {
    $trail->parent('admin.forms.show', $form);
    $trail->push('Fields', route('admin.fields.index', $form));
});

Breadcrumbs::for('admin.fields.edit', function ($trail, $form, $field) {
    $trail->parent('admin.fields.index', $form);
    $trail->push($field->title, route('admin.fields.edit', [$form, $field]));
});

Breadcrumbs::for('admin.options.index', function ($trail, $form, $field) {
    $trail->parent('admin.fields.edit', $form, $field);
    $trail->push('Options', route('admin.options.index', [$form, $field]));
});
