<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => 'All',
        'yes' => 'Yes',
        'no' => 'No',
        'copyright' => 'Copyright',
        'custom' => 'Custom',
        'actions' => 'Actions',
        'active' => 'Active',
        'buttons' => [
            'save' => 'Save',
            'update' => 'Update',
            'delete' => 'Delete',
            'export'    => 'Export',
            'import'    => 'Import',
        ],
        'hide' => 'Hide',
        'inactive' => 'Inactive',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new' => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more' => 'More',
        'logout'    => 'Logout'
    ],
    'import' => [
        'sucess' => 'File imported',
        'failes' => 'File failed',
    ],
    'export' => [
        'sucess' => 'File exported',
        'failes' => 'File failed',
    ],

    'customers' => [
        'title' => 'Customers'
    ],
    'products' => [
        'name'  => 'Name',
        'view'  => 'Product details',
        'management' => 'Product Management',
        'stock_management' => 'Stock Management',
        'pricing_management'    => 'Pricing Management',
        'category_management'   => 'Category Management',
        'pricing_history'   => 'Pricing History',
        'stock_history'   => 'Stock History',
        'amount'  => 'Amount',
         
        'warehouse' => 'Warehouse',
        'stock_type' => 'Stock Type',
        'pricing_group' => 'Pricing Group',
        'quantity' => 'Quantity',
        'from_date'  => 'from date',
        'to_date'  => 'to date',
        'pricing'   => [
            'created'   => 'Pricing created',
            'updated'   => 'Pricing update',
            'deleted'   => 'Pricing deleted',
        ],
        'stock'   => [
            'created'   => 'Stock created',
            'updated'   => 'Stock update',
            'deleted'   => 'Stock deleted',
        ],
        'categories'   => [
            'all'   => 'Categories',
            'created'   => 'Category added to product',
            'exist'   => 'The category existing in the product',
            'deleted'   => 'The category removed from the product',
            
        ],
        'orders'    => [
            'management'    => 'Order Management'
        ]
    ],
    'accounts' => [
        'portal'  => 'Account Portal',
        'view'  => 'Account details',
        'management' => 'Account Management',
        'name'  => 'Name',
        'email' => 'Email',
        'password'  => 'Password',
        'password_confirmation' => 'Confirm',
        'created'   => 'Account created',
        'updated'   => 'Account updated',
    ]   ,
    'pricing_groups' => [
        'title' => 'Definition Pricing Groups',
        'management' => 'Pricing Group Management',
        'name'  => 'Pricing Group Name',
        'pricing_count_definitions' => '{0} no pricing definitions will be deleted|[1,*] :count   pricing definitions will be deleted',
        'created'   => 'Pricing Group created!',
        'updated'   => 'Pricing Group updated!',
        'deleted'   => 'Pricing Group deleted!',
    ], 
    
    'stock_types' => [
        'title' => 'Definition Stock Types',
        'management' => 'Stock Type Management',
        'name'  => 'Stock Type Name',
        'stocks_count_definitions' => '{0} no stock definitions will be deleted|[1,*] :count stock definitions will be deleted',
        'created'   => 'Stock Type created!',
        'updated'   => 'Stock Type updated!',
        'deleted'   => 'Stock Type deleted!',
    ],     

    'categories' => [
        'title' => 'Categories',
        'management' => 'Category Management',
        'name'  => 'Category Name',
        'breadcrumb'  => 'Breadcrumb',
        'taxonomy_id'  => 'Taxonomy ID',
        'parent_id'  => 'Parent ID',       
        'created'   => 'Category created!',
        'updated'   => 'Category updated!',
        'deleted'   => 'Category deleted!',
    ],    

    'warehouses' => [
        'title' => 'Warehouses',
        'management' => 'Warehouse Management',
        'name'  => 'Warehouse Name',
        'breadcrumb'  => 'Breadcrumb',
        'stocks_count_definitions' => '{0} no stock definitions will be deleted|[1,*] :count stock definitions will be deleted',
        'created'   => 'Warehouse created!',
        'updated'   => 'Warehouse updated!',
        'deleted'   => 'Warehouse deleted!',
    ],        

    'profile'   => [
        'name'  => 'Name',
        'email'  => 'Email',
        'password'  => 'Password',
        'password_confirmation' => 'Confirmation'

    ],

    'imports' => [
        'management'    => "Import"
    ],

    'exports' => [
        'management'    => "Export"
    ],
 
    'auth'  => [
        'login_box_title'   => 'Login',
        'remember_me'   => 'Remember me',
        'forgot_password'   => 'I forgot my password',
        'login_button'  => 'Login',
        'forgot_password'   => 'I forgot my password'  ,
        'reset_password_box_title'  => "Reset Password",
        'send_password_reset_link_button'   => 'Send Password Reset Link'
    ]
];
