<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'transactions' => [
        'name' => 'Transactions',
        'index_title' => 'Transactions List',
        'new_title' => 'New Transaction',
        'create_title' => 'Create Transaction',
        'edit_title' => 'Edit Transaction',
        'show_title' => 'Show Transaction',
        'inputs' => [
            'folio' => 'Folio',
            'applicant_id' => 'Applicant',
            'order_id' => 'Order',
            'status' => 'Status',
        ],
    ],

    'applicants' => [
        'name' => 'Applicants',
        'index_title' => 'Applicants List',
        'new_title' => 'New Applicant',
        'create_title' => 'Create Applicant',
        'edit_title' => 'Edit Applicant',
        'show_title' => 'Show Applicant',
        'inputs' => [
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'fecha_de_nacimiento' => 'Fecha De Nacimiento',
            'sexo' => 'Sexo',
            'curp' => 'Curp',
            'correo_electronico' => 'Correo Electronico',
            'address' => 'Address',
        ],
    ],

    'applicant_incomes' => [
        'name' => 'Applicant Incomes',
        'index_title' => 'Incomes List',
        'new_title' => 'New Income',
        'create_title' => 'Create Income',
        'edit_title' => 'Edit Income',
        'show_title' => 'Show Income',
        'inputs' => [
            'empresa' => 'Empresa',
            'comprobante_ingresos' => 'Comprobante Ingresos',
            'salario_bruto' => 'Salario Bruto',
            'salario_neto' => 'Salario Neto',
            'tipo_empleo' => 'Tipo Empleo',
            'fecha_contratacion' => 'Fecha Contratacion',
        ],
    ],

    'orders' => [
        'name' => 'Orders',
        'index_title' => 'Orders List',
        'new_title' => 'New Order',
        'create_title' => 'Create Order',
        'edit_title' => 'Edit Order',
        'show_title' => 'Show Order',
        'inputs' => [
            'destino' => 'Destino',
            'monto_solicitado' => 'Monto Solicitado',
            'plazo' => 'Plazo',
        ],
    ],

    'applicant_transactions' => [
        'name' => 'Applicant Transactions',
        'index_title' => 'Transactions List',
        'new_title' => 'New Transaction',
        'create_title' => 'Create Transaction',
        'edit_title' => 'Edit Transaction',
        'show_title' => 'Show Transaction',
        'inputs' => [
            'folio' => 'Folio',
            'status' => 'Status',
            'order_id' => 'Order',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
